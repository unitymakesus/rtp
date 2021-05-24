<?php

if (!class_exists('XmlExportCustomRecord')) {
    final class XmlExportCustomRecord {

        private $default_fields = [];

        private $author_fields = [];

        private $other_fields = [];

        private $parent_fields = [];

        private $advanced_fields = [];

        public static $is_active = true;

        public function __construct() {
            if (XmlExportEngine::$exportOptions['export_type'] == 'specific' and strpos(XmlExportEngine::$exportOptions['cpt'][0], 'custom_') !== 0) {
                self::$is_active = false;
                return;
            }

            do_action('pmxe_custom_record_export', XmlExportEngine::$exportOptions);
        }


        // [\FILTERS]

        public function init(& $existing_meta_keys = array()) {
            if (!self::$is_active) return;

            if(PMXE_Plugin::$session->get('exportQuery') && !XmlExportEngine::$exportQuery) {
                XmlExportEngine::$exportQuery = PMXE_Plugin::$session->get('exportQuery');
            }
        }

        public static function prepare_data($record, $exportOptions, $xmlWriter = false, $implode_delimiter, $preview) {
            $article = array();

            if (wp_all_export_is_compatible() && isset($exportOptions['is_generate_import']) && $exportOptions['is_generate_import'] && $exportOptions['import_id']) {
                $postRecord = new PMXI_Post_Record();
                $postRecord->clear();
                $postRecord->getBy(array(
                    'post_id' => $record->id,
                    'import_id' => $exportOptions['import_id'],
                ));

                if ($postRecord->isEmpty()) {
                    $postRecord->set(array(
                        'post_id' => $record->id,
                        'import_id' => $exportOptions['import_id'],
                        'unique_key' => $record->id
                    ))->save();
                }
                unset($postRecord);
            }

            $is_xml_export = false;

            if (
                !empty($xmlWriter) &&
                isset($exportOptions['export_to']) &&
                $exportOptions['export_to'] == 'xml' &&
                !in_array($exportOptions['xml_template_type'], array('custom', 'XmlGoogleMerchants')))
            {
                $is_xml_export = true;
            }

            foreach ($exportOptions['ids'] as $ID => $value) {
                $fieldName = apply_filters('wp_all_export_field_name', wp_all_export_parse_field_name($exportOptions['cc_name'][$ID]), $ID);
                $fieldValue = $exportOptions['cc_value'][$ID];
                $fieldLabel = $exportOptions['cc_label'][$ID];
                $fieldSql = $exportOptions['cc_sql'][$ID];
                $fieldPhp = $exportOptions['cc_php'][$ID];
                $fieldCode = $exportOptions['cc_code'][$ID];
                $fieldType = $exportOptions['cc_type'][$ID];
                $fieldOptions = $exportOptions['cc_options'][$ID];
                $fieldSettings = empty($exportOptions['cc_settings'][$ID]) ? $fieldOptions : $exportOptions['cc_settings'][$ID];

                if (empty($fieldName) or empty($fieldType) or !is_numeric($ID)) continue;

                $element_name = (!empty($fieldName)) ? $fieldName : 'untitled_' . $ID;

                $element_name_ns = '';

                if ($is_xml_export) {
                    //$element_name = (!empty($fieldName)) ? preg_replace('/[^a-z0-9_:-]/i', '', $fieldName) : 'untitled_' . $ID;

                    if (strpos($element_name, ":") !== false) {
                        $element_name_parts = explode(":", $element_name);
                        $element_name_ns = (empty($element_name_parts[0])) ? '' : $element_name_parts[0];
                        $element_name = (empty($element_name_parts[1])) ? 'untitled_' . $ID : preg_replace('/[^a-z0-9_-]/i', '', $element_name_parts[1]);
                    }
                }

                $fieldSnipped = (!empty($fieldPhp) and !empty($fieldCode)) ? $fieldCode : false;

                if (isset($exportOptions['cc_combine_multiple_fields'][$ID]) && $exportOptions['cc_combine_multiple_fields'][$ID]) {

                    $combineMultipleFieldsValue = $exportOptions['cc_combine_multiple_fields_value'][$ID];

                    $combineMultipleFieldsValue = stripslashes($combineMultipleFieldsValue);
                    $snippetParser = new \Wpae\App\Service\SnippetParser();
                    $snippets = $snippetParser->parseSnippets($combineMultipleFieldsValue);
                    $engine = new XmlExportEngine(XmlExportEngine::$exportOptions);
                    $engine->init_available_data();
                    $engine->init_additional_data();
                    $snippets = $engine->get_fields_options($snippets);

                    $articleData = self::prepare_data($record, $snippets, $xmlWriter, $implode_delimiter, $preview);

                    $functions = $snippetParser->parseFunctions($combineMultipleFieldsValue);
                    $combineMultipleFieldsValue = \Wpae\App\Service\CombineFields::prepareMultipleFieldsValue($functions, $combineMultipleFieldsValue, $articleData);

                    if ($preview) {
                        $combineMultipleFieldsValue = trim(preg_replace('~[\r\n]+~', ' ', htmlspecialchars($combineMultipleFieldsValue)));
                    }

                    wp_all_export_write_article($article, $element_name, pmxe_filter($combineMultipleFieldsValue, $fieldSnipped));

                } else {


                    $addon = GF_Export_Add_On::get_instance();
                    $addon->add_on->handle_element($article, $element_name, $fieldValue, $record, $fieldSnipped);

                }

                if ($is_xml_export and isset($article[$element_name])) {

                    $element_name_in_file = XmlCsvExport::_get_valid_header_name($element_name);

                    $element_name_in_file = str_replace(' ', '', $element_name_in_file);
                    $element_name_in_file = str_replace('-', '_', $element_name_in_file);
                    $element_name_in_file = str_replace('/', '_', $element_name_in_file);

                    $xmlWriter = apply_filters('wp_all_export_add_before_element', $xmlWriter, $element_name_in_file, XmlExportEngine::$exportID, $record->id);

                    $xmlWriter->beginElement($element_name_ns, $element_name_in_file, null);
                    $xmlWriter->writeData($article[$element_name], $element_name_in_file);
                    $xmlWriter->closeElement();

                    $xmlWriter = apply_filters('wp_all_export_add_after_element', $xmlWriter, $element_name_in_file, XmlExportEngine::$exportID, $record->id);

                }
            }

            return $article;
        }

        public static function prepare_import_template( $exportOptions, &$templateOptions, $element_name, $ID) {

            return;
        }

        /**
         * __get function.
         *
         * @access public
         * @param mixed $key
         * @return mixed
         */
        public function __get($key) {
            return $this->get($key);
        }

        /**
         * Get a session variable
         *
         * @param string $key
         * @param  mixed $default used if the session variable isn't set
         * @return mixed value of session variable
         */
        public function get($key, $default = null) {
            return isset($this->{$key}) ? $this->{$key} : $default;
        }

    }
}
