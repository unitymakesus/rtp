(function($){

    FLBuilder.registerModuleHelper('blog-posts', {

        init: function() {
            var form        = $('.fl-builder-settings'),
                is_carousel = form.find('select[name=is_carousel]'),
                img_size = form.find('select[name=featured_image_size]'),
                show_featured_image = form.find('select[name=show_featured_image]'),
                post_type = form.find('select[name=post_type]'),
                enable_arrow = form.find('select[name=enable_arrow]'),
                post_per_grid_desktop = form.find('select[name=post_per_grid_desktop]'),
                post_per_grid = form.find('select[name=post_per_grid]'),
                carousal_type  = form.find('select[name=total_posts_switch]'),
                show_pagination = form.find('select[name=show_pagination]'),
                tax_filter_div = form.find('#fl-builder-settings-section-masonary_filter .fl-loop-builder-masonary_filter').find('select'),
                btn_flat_button_options = form.find('select[name=btn_flat_button_options]'),
                btn_style = form.find('select[name=btn_style]'),
                pagination = form.find('select[name=pagination]'),
                show_meta = form.find('select[name=show_meta]'),
                show_excerpt = form.find('select[name=show_excerpt]'),
                show_title = form.find('select[name=show_title]'),
                show_date_box = form.find('select[name=show_date_box]'),
                cta_type = form.find('select[name=cta_type]'),
                show_date = form.find('select[name=show_date]'),
                show_author = form.find('select[name=show_author]'),
                show_categories = form.find('select[name=show_categories]'),
                show_tags = form.find('select[name=show_tags]'),
                show_comments = form.find('select[name=show_comments]'),
                blog_image_position = form.find('select[name=blog_image_position]'),
                mobile_structure = form.find( 'select[name=mobile_structure]' );
                order_by = form.find('select[name=order_by]');

            order_by.on('change',$.proxy( this._selectionOrder, this ))
            show_title.on('change', $.proxy( this._hideTypography, this ) );
            show_excerpt.on('change', $.proxy( this._hideTypography, this ) );
            show_meta.on('change', $.proxy( this._hideTypography, this ) );
            show_date_box.on('change', $.proxy( this._hideTypography, this ) );
            cta_type.on('change', $.proxy( this._hideTypography, this ) );
            show_featured_image.on('change', $.proxy( this._hideTypography, this ) );
            pagination.on('change', $.proxy( this._togglePagination, this ) );

            carousal_type.on('change', $.proxy( this._toggle, this ) );
            is_carousel.on('change', $.proxy( this._toggleSection, this ) );
            is_carousel.on('change', $.proxy( this._toggleGrid, this ) );
            tax_filter_div.on('change', $.proxy( this._toggleTaxFilter, this ) );
            is_carousel.on('change', $.proxy( this._toggleTaxFilter, this ) );
            show_featured_image.on('change', $.proxy( this._toggleFeaturedImageSection, this ) );
            mobile_structure.on( 'change', $.proxy( this._toggleFeaturedImageSection, this ) );
            blog_image_position.on('change', $.proxy( this._toggleFeaturedImageSection, this ) );
            enable_arrow.on('change', $.proxy( this._toggleArrowSettings, this ) );
            img_size.on('change', $.proxy( this._toggleFeaturedImageSection, this ) );
            post_type.on('change', $.proxy( this._toggleSection, this ) );
            post_type.on('change', $.proxy( this._toggleTaxFilter, this ) );

            post_per_grid_desktop.on('change', $.proxy( this._toggleGrid, this ) );
            post_per_grid.on('change', $.proxy( this._toggleGridChange, this ) );
            show_pagination.on('change', $.proxy( this._toggleSection, this ) );
            show_pagination.on('change', $.proxy( this._toggleTaxFilter, this ) );

            btn_flat_button_options.on('change', this._flatBtnOption);
            btn_style.on('change', this._flatBtnOption);

            show_meta.on('change', $.proxy( this._toggleMeta, this ) );
            show_date.on('change', $.proxy( this._toggleMeta, this ) );
            show_author.on('change', $.proxy( this._toggleMeta, this ) );
            show_categories.on('change', $.proxy( this._toggleMeta, this ) );
            show_tags.on('change', $.proxy( this._toggleMeta, this ) );
            show_comments.on('change', $.proxy( this._toggleMeta, this ) );

            show_excerpt.on('change', $.proxy( this._toggleContent, this ));
            show_title.on('change', $.proxy( this._toggleContent, this ));

            $( this._toggleFeaturedImageSection, this );
            $( this._toggle, this );
            $( this._toggleSection, this );
            $( this._toggleArrowSettings, this );
            $( this._toggleTaxFilter, this );
            $( this._flatBtnOption, this );
            $( this._toggleMeta, this );
            $( this._toggleContent, this );
            $( this._togglePagination, this );
            $( this._hideTypography, this );

            this._hideDocs();

            $( this._selectionOrder, this );

            $("#fl-field-layout_sort_order").find( ".uabb-sortable" ).sortable({
                out: function( event, ui ) {
                    setTimeout( function() {
                        var input = $("#fl-field-layout_sort_order").find("input[name=layout_sort_order]").val(),
                        blog_image_position = form.find('select[name=blog_image_position]').val();

                        if( blog_image_position == 'top' ) {
                            if( input.substring(0, 3) == 'img' || input.slice(-3) == 'img' ) {
                                form.find('#fl-field-overall_padding_dimension').show();
                            } else {
                                form.find('#fl-field-overall_padding_dimension').hide();
                            }
                        } else if( blog_image_position == 'background' ) {
                            form.find('#fl-field-overall_padding_dimension').hide();
                        } else {
                            form.find('#fl-field-overall_padding_dimension').show();
                        }
                    } , 500);
                }
            });

            UABBButton.init();
        },

        _hideTypography: function() {
            var form        = $('.fl-builder-settings'),
                show_meta = form.find('select[name=show_meta]').val(),
                show_excerpt = form.find('select[name=show_excerpt]').val(),
                show_title = form.find('select[name=show_title]').val(),
                show_date_box = form.find('select[name=show_date_box]').val(),
                cta_type = form.find('select[name=cta_type]').val(),
                show_featured_image    = form.find('select[name=show_featured_image]').val(),
                post_layout = form.find('select[name=post_layout]').val();

            if( show_meta == 'no' && show_excerpt == 'no' && show_title == 'no' && show_date_box == 'no' && cta_type == 'none' ) {
                form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-typography"]').hide();
            } else {
                form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-typography"]').show();
            }

            if( cta_type == 'none' ) {
                form.find('#fl-field-layout_sort_order .uabb-sortable .cta').hide();
            } else {
                form.find('#fl-field-layout_sort_order .uabb-sortable .cta').show();
            }

            if( show_featured_image == 'no' && show_meta == 'no' && show_excerpt == 'no' && show_title == 'no' && cta_type == 'none' && cta_type == 'none' ) {
                form.find('#fl-field-layout_sort_order').hide();
                form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-layout"]').hide();
            } else {
                if( ( show_featured_image == 'yes' && show_meta == 'no' && show_excerpt == 'no' && show_title == 'no' && cta_type == 'none' && cta_type == 'none' ) || ( show_featured_image == 'no' && show_meta == 'yes' && show_excerpt == 'no' && show_title == 'no' && cta_type == 'none' ) || ( show_featured_image == 'no' && show_meta == 'no' && show_excerpt == 'yes' && show_title == 'no' && cta_type == 'none' ) || ( show_featured_image == 'no' && show_meta == 'no' && show_excerpt == 'no' && show_title == 'yes' && cta_type == 'none' ) || ( show_featured_image == 'no' && show_meta == 'no' && show_excerpt == 'no' && show_title == 'no' && cta_type != 'none' ) ) {

                    form.find('#fl-field-layout_sort_order').hide();
                    form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-layout"]').hide();

                } else {
                    form.find('#fl-field-layout_sort_order').show();
                    form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-layout"]').show();
                }
            }

            if( post_layout == 'custom' ) {
                form.find('.fl-builder-settings-tabs a[href="#fl-builder-settings-tab-layout"]').hide();
            }
        },

        _toggleContent: function() {
            var form        = $('.fl-builder-settings'),
                show_excerpt    = form.find('select[name=show_excerpt]').val(),
                content_type = form.find('select[name=content_type]').val(),
                show_title = form.find('select[name=show_title]').val();

            if( show_excerpt == 'yes' ) {
                form.find('#fl-field-content_type').show();
                form.find('#fl-builder-settings-section-desc_typography').show();
                form.find('#fl-field-layout_sort_order .uabb-sortable .content').show();
                if( content_type == 'custom' ) {
                    form.find('#fl-field-excerpt_count').show();
                } else {
                    form.find('#fl-field-excerpt_count').hide();
                }

                if( content_type == 'excerpt' || content_type == 'content' ) {
                    form.find('#fl-field-strip_content_html').show();
                } else {
                    form.find('#fl-field-strip_content_html').hide();
                }

            } else {
                form.find
                form.find('#fl-field-content_type').hide();
                form.find('#fl-field-excerpt_count').hide();
                form.find('#fl-field-strip_content_html').hide();
                form.find('#fl-builder-settings-section-desc_typography').hide();
                form.find('#fl-field-layout_sort_order .uabb-sortable .content').hide();
            }

            if( show_title == 'yes' ) {
                form.find('#fl-field-layout_sort_order .uabb-sortable .title').show();
            } else {
                form.find('#fl-field-layout_sort_order .uabb-sortable .title').hide();
            }
        },

        _toggleMeta: function () {
            var form        = $('.fl-builder-settings'),
                show_meta    = form.find('select[name=show_meta]').val(),
                show_date = form.find('select[name=show_date]').val(),
                show_author = form.find('select[name=show_author]').val(),
                show_categories = form.find('select[name=show_categories]').val(),
                show_tags = form.find('select[name=show_tags]').val(),
                show_comments = form.find('select[name=show_comments]').val();

            if( show_meta == 'yes' ) {

                form.find('#fl-field-show_author').show();
                form.find('#fl-field-show_date').show();
                form.find('#fl-field-show_categories').show();
                form.find('#fl-field-show_tags').show();
                form.find('#fl-field-show_comments').show();
                form.find('#fl-builder-settings-section-meta_sort_order').show();
                form.find('#fl-field-layout_sort_order .uabb-sortable .meta').show();
 
                if( show_date == 'yes' ) {
                    form.find('#fl-field-date_format').show();
                    form.find('#fl-field-meta_sort_order .uabb-sortable .date').show();
                } else {
                    form.find('#fl-field-date_format').hide();
                    form.find('#fl-field-meta_sort_order .uabb-sortable .date').hide();
                }

                if( show_author == 'yes' ) {
                    form.find('#fl-field-meta_sort_order .uabb-sortable .author').show();
                } else {
                    form.find('#fl-field-meta_sort_order .uabb-sortable .author').hide();
                }

                if( show_comments == 'yes' ) {
                    form.find('#fl-field-meta_sort_order .uabb-sortable .comment').show();
                } else {
                    form.find('#fl-field-meta_sort_order .uabb-sortable .comment').hide();
                }

                if( show_categories == 'yes' || show_tags == 'yes' ) {
                    form.find('#fl-field-meta_sort_order .uabb-sortable .taxonomy').show();
                } else {
                    form.find('#fl-field-meta_sort_order .uabb-sortable .taxonomy').hide();
                }

                if( show_categories != 'yes' && show_tags != 'yes' && show_comments != 'yes' && show_author != 'yes' && show_date != 'yes' ) {
                    form.find('#fl-builder-settings-section-meta_sort_order').hide();
                } else {
                    form.find('#fl-builder-settings-section-meta_sort_order').show();
                }

            } else {
                form.find('#fl-field-show_author').hide();
                form.find('#fl-field-show_date').hide();
                form.find('#fl-field-show_categories').hide();
                form.find('#fl-field-show_tags').hide();
                form.find('#fl-field-show_comments').hide();
                form.find('#fl-field-date_format').hide();
                form.find('#fl-builder-settings-section-meta_sort_order').hide();
                form.find('#fl-field-layout_sort_order .uabb-sortable .meta').hide();
            }
        },

        _togglePagination: function() {

            var form        = $('.fl-builder-settings'),
            show_pagination = form.find('select[name=show_pagination]').val(),
            is_carousel    = form.find('select[name=is_carousel]').val(),
            pagination = form.find('select[name=pagination]').val();
            if( show_pagination == 'yes' && pagination == 'scroll' && is_carousel != 'masonary' ) {
                form.find('#fl-field-show_paginate_loader').show();
                form.find('#fl-field-total_posts_switch').hide();
                form.find('#fl-field-total_posts').hide();
            }
            else {
                form.find('#fl-field-show_paginate_loader').hide();
                form.find('#fl-field-total_posts_switch').show();
                form.find('#fl-field-total_posts').show();
            }
        },

        _flatBtnOption: function() {

            var form        = $('.fl-builder-settings'),
                cta_type    = form.find('select[name=cta_type]').val(),
                btn_style = form.find('select[name=btn_style]').val(),
                btn_flat_button_options = form.find('select[name=btn_flat_button_options]').val();

            if( cta_type == 'button' ) {
                if( btn_style == 'flat' ) {
                    if( btn_flat_button_options != 'none' ) {
                        form.find('#fl-field-btn_icon_position').hide();
                    } else {
                        form.find('#fl-field-btn_icon_position').show();
                    }
                } else {
                    form.find('#fl-field-btn_icon_position').show();
                }
            }

        },

        _toggleTaxFilter: function() {

            var form = $('.fl-builder-settings'),
                tax_filter_div = form.find('#fl-builder-settings-section-masonary_filter .fl-loop-builder-masonary_filter'),
                is_carousel    = form.find('select[name=is_carousel]').val(),
                post_type = form.find('select[name=post_type]').val(),
                show_pagination = form.find('select[name=show_pagination]').val(),
                pagination = form.find('select[name=pagination]').val(),
                filter_type    = form.find('select[name=uabb_masonary_filter_type_'+post_type+']').val(),
                is_no_filter = form.find('select[name=masonary_filter_'+post_type+']').val(),
                edit_label_all = form.find('select[name=uabb_masonary_filter_all_edit_'+post_type+']');

                form.find('.fl-loop-builder-filter').hide();
                form.find('.fl-loop-builder-' + post_type + '-filter').show();
            if( is_carousel == 'masonary' || is_carousel == 'grid' ) {
                tax_filter_div.hide();

                if ( form.find('.fl-loop-builder-'+post_type+'-masonary_filter').children().length > 0 ) {
                    
                    form.find('.fl-loop-builder-masonary_filter').hide();
                    form.find('.fl-loop-builder-'+post_type+'-masonary_filter').show();
                    form.find('#fl-builder-settings-section-masonary_filter').show();

                    if( is_no_filter == -1 ) {
                        form.find('#fl-builder-settings-section-pagination_setting').show();
                        if( show_pagination == 'yes' && pagination == 'numbers' ) {
                            form.find('#fl-builder-settings-section-pagination_style').show();
                        } else {
                            form.find('#fl-builder-settings-section-pagination_style').hide();
                        }
                        form.find('#fl-builder-settings-section-masonary_style').hide();
                        form.find('#fl-builder-settings-section-masonary_select_style').hide();
                        form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').hide();
                        edit_label_all.hide();
                    } else {
                        edit_label_all.show();
                        form.find('#fl-builder-settings-section-pagination_setting').hide();
                        form.find('#fl-builder-settings-section-pagination_style').hide();
                        form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').show();
                        if( filter_type == 'drop-down' ) {
                            form.find('#fl-builder-settings-section-masonary_select_style').show();
                            form.find('#fl-builder-settings-section-masonary_style').hide();
                            form.find('#fl-field-taxonomy_filter_select_color').show();
                        }
                        else {
                            form.find('#fl-builder-settings-section-masonary_style').show();
                            form.find('#fl-builder-settings-section-masonary_select_style').hide();
                            form.find('#fl-field-taxonomy_filter_select_color').hide();
                        }
                    }
                } else {
                    form.find('#fl-builder-settings-section-masonary_filter').hide();
                    form.find('#fl-builder-settings-section-masonary_style').hide();
                    form.find('#fl-builder-settings-section-masonary_select_style').hide();
                    form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').hide();
                    form.find('#fl-builder-settings-section-pagination_setting').show();
                    if( show_pagination == 'yes' && pagination == 'numbers' ) {
                        form.find('#fl-builder-settings-section-pagination_style').show();
                    } else {
                        form.find('#fl-builder-settings-section-pagination_style').hide();
                    }
                }
            }
        },

        _toggleGrid: function() {
            var form = $('.fl-builder-settings'),
                post_per_grid = form.find('select[name=post_per_grid]').val(),
                post_per_grid_desktop = form.find('select[name=post_per_grid_desktop]').val();

            form.find('select[name=post_per_grid]').val( post_per_grid_desktop );
        },

        _toggleGridChange: function() {
            var form = $('.fl-builder-settings'),
                post_per_grid = form.find('select[name=post_per_grid]').val(),
                post_per_grid_desktop = form.find('select[name=post_per_grid_desktop]').val();

            form.find('select[name=post_per_grid_desktop]').val( post_per_grid );
        },

        _toggle: function() {
            var form        = $('.fl-builder-settings'),
                carousal_type    = form.find('select[name=total_posts_switch]').val(),
                data_source = form.find('select[name=data_source]').val();

            if( carousal_type == 'all' ) {
                form.find('#fl-field-total_posts').hide();
            } else {
                form.find('#fl-field-total_posts').show();
            }

            if ( data_source == 'main_query' ) {
                form.find('#fl-field-posts_per_page').hide();
            }
        },

        _toggleArrowSettings: function() {
            var form        = $('.fl-builder-settings'),
                is_carousel    = form.find('select[name=is_carousel]').val(),
                enable_arrow = form.find('select[name=enable_arrow]').val(),
                arrow_style = form.find('select[name=arrow_style]').val(),
                carousal_type    = form.find('select[name=total_posts_switch]').val();

            if( is_carousel == 'carousel' ) {

                if( enable_arrow == 'yes' ) {
                    form.find('#fl-field-arrow_color').show();
                    form.find( '#fl-field-arrow_style' ).show();
                    form.find( '#fl-field-arrow_position' ).show();
                    form.find('#fl-field-icon_left').show();
                    form.find('#fl-field-icon_right').show();
                    if( arrow_style == 'square-border' || arrow_style == 'circle-border' ) {
                        form.find( '#fl-field-arrow_background_color' ).hide();
                        form.find( '#fl-field-arrow_background_color_opc' ).hide();

                        form.find( '#fl-field-arrow_color_border' ).show();
                        form.find( '#fl-field-arrow_border_size' ).show();
                    } else {
                        form.find( '#fl-field-arrow_background_color' ).show();
                        form.find( '#fl-field-arrow_background_color_opc' ).show();

                        form.find( '#fl-field-arrow_color_border' ).hide();
                        form.find( '#fl-field-arrow_border_size' ).hide();
                    }
                } else {
                    form.find('#fl-field-icon_left').hide();
                    form.find('#fl-field-icon_right').hide();
                    form.find('#fl-field-arrow_color').hide();
                    form.find( '#fl-field-arrow_style' ).hide();
                    form.find( '#fl-field-arrow_background_color' ).hide();
                    form.find( '#fl-field-arrow_background_color_opc' ).hide();
                    form.find( '#fl-field-arrow_color_border' ).hide();
                    form.find( '#fl-field-arrow_border_size' ).hide();
                    form.find( '#fl-field-arrow_position' ).hide();
                }
            }
        },

        _toggleFeaturedImageSection: function() {
            var form        = $('.fl-builder-settings'),
                featured_image_size    = form.find('select[name=featured_image_size]').val(),
                show_date_box    = form.find('select[name=show_date_box]').val(),
                show_featured_image    = form.find('select[name=show_featured_image]').val(),
                blog_image_position = form.find('select[name=blog_image_position]').val(),
                mobile_structure = form.find( 'select[name=mobile_structure]' ).val(),
                input = $("#fl-field-layout_sort_order").find("input[name=layout_sort_order]").val();
            
            if( blog_image_position == 'top' ) {
                if( input.substring(0, 3) == 'img' || input.slice(-3) == 'img' ) {
                    form.find('#fl-field-overall_padding_dimension').show();
                } else {
                    form.find('#fl-field-overall_padding_dimension').hide();
                }
            } else if( blog_image_position == 'background' ) {
                form.find('#fl-field-overall_padding_dimension').hide();
            } else {
                form.find('#fl-field-overall_padding_dimension').show();
            }

            if( blog_image_position == 'left' || blog_image_position == 'right' ) {
                // show mobile_structure
                form.find('#fl-field-mobile_structure').show();
                /*if( mobile_structure == 'stack' && blog_image_position == 'right' ) {
                    form.find('#fl-field-stacking_order').show();
                } else {
                    form.find('#fl-field-stacking_order').hide();
                }*/

            } else {
                form.find('#fl-field-mobile_structure').hide();
                //form.find('#fl-field-stacking_order').hide();
            }

            if( show_featured_image == 'yes' ) {
                
                form.find('#fl-field-featured_image_size').show();
                form.find('#fl-field-show_date_box').show();
                form.find('#fl-field-blog_image_position').show();

                if( blog_image_position == 'background' ) {
                    form.find('#fl-field-overlay_color').show();
                    form.find('#fl-field-overlay_color_opc').show();
                    form.find('#fl-field-content_background_color').hide();
                    form.find('#fl-field-content_background_color_opc').hide();
                    form.find('#fl-field-layout_sort_order .uabb-sortable .img').hide();
                } else if( blog_image_position == 'top' ) {
                    form.find('#fl-field-overlay_color').hide();
                    form.find('#fl-field-overlay_color_opc').hide();
                    form.find('#fl-field-content_background_color').show();
                    form.find('#fl-field-content_background_color_opc').show();
                    form.find('#fl-field-layout_sort_order .uabb-sortable .img').show();
                } else {
                    form.find('#fl-field-overlay_color').hide();
                    form.find('#fl-field-overlay_color_opc').hide();
                    form.find('#fl-field-content_background_color').show();
                    form.find('#fl-field-content_background_color_opc').show();
                    form.find('#fl-field-layout_sort_order .uabb-sortable .img').hide();
                }

                if( show_date_box == 'yes' ) {
                    form.find('#fl-builder-settings-section-date_typography').show();
                } else {
                    form.find('#fl-builder-settings-section-date_typography').hide();
                }

                if( featured_image_size == 'custom' ) {
                    form.find('#fl-field-featured_image_size_width').show();
                    form.find('#fl-field-featured_image_size_height').show();
                } else {
                    form.find('#fl-field-featured_image_size_width').hide();
                    form.find('#fl-field-featured_image_size_height').hide();
                }
            } else {
                form.find('#fl-field-featured_image_size').hide();
                form.find('#fl-field-show_date_box').hide();
                form.find('#fl-field-featured_image_size_width').hide();
                form.find('#fl-field-featured_image_size_height').hide();
                form.find('#fl-builder-settings-section-date_typography').hide();
                form.find('#fl-field-blog_image_position').hide();
                form.find('#fl-field-overlay_color').hide();
                form.find('#fl-field-overlay_color_opc').hide();
                form.find('#fl-field-content_background_color').show();
                form.find('#fl-field-content_background_color_opc').show();
                form.find('#fl-field-layout_sort_order .uabb-sortable .img').hide();
            }
        },

        _toggleSection: function() {
            var form        = $('.fl-builder-settings'),
                is_carousel    = form.find('select[name=is_carousel]').val(),
                enable_arrow = form.find('select[name=enable_arrow]').val(),
                arrow_style = form.find('select[name=arrow_style]').val(),
                post_type = form.find('select[name=post_type]').val(),
                carousal_type    = form.find('select[name=total_posts_switch]').val(),
                show_pagination = form.find('select[name=show_pagination]').val(),
                pagination = form.find('select[name=pagination]').val(),
                data_source = form.find('select[name=data_source]').val(),
                filter_type    = form.find('select[name=uabb_masonary_filter_type_'+post_type+']').val(),
                is_no_filter = form.find('select[name=masonary_filter_'+post_type+']').val();

            if ( data_source == 'main_query' || show_pagination == 'no' ) {
                form.find('#fl-field-posts_per_page').hide();
            }
            if ( data_source == 'custom_query' && show_pagination == 'yes' ) {
                form.find('#fl-field-posts_per_page').show();
            }

            if( show_pagination == 'yes' && pagination == 'scroll' && is_carousel != 'masonary' ) {
                form.find('#fl-field-show_paginate_loader').show();
                form.find('#fl-field-total_posts_switch').hide();
                form.find('#fl-field-total_posts').hide();
            }
            else {
                form.find('#fl-field-show_paginate_loader').hide();
                form.find('#fl-field-total_posts_switch').show();
                form.find('#fl-field-total_posts').show();
            }

            if( is_carousel == 'grid' ) {
                form.find('#fl-builder-settings-section-carousel_filter').hide();
                form.find('#fl-builder-settings-section-grid_filter').show();
                form.find('#fl-builder-settings-section-masonary_filter').show();
                form.find('#fl-field-post_per_grid_desktop').show();
                form.find('#fl-field-below_element_space').show();
                form.find('#fl-field-post_per_grid').hide();
                form.find('#fl-builder-settings-section-masonary_style').hide();
                form.find('#fl-builder-settings-section-masonary_select_style').hide();
                form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').hide();
                form.find('#fl-builder-settings-section-pagination_setting').show();
                if( show_pagination == 'yes' && pagination == 'numbers' ) {
                    form.find('#fl-builder-settings-section-pagination_style').show();
                } else {
                    form.find('#fl-builder-settings-section-pagination_style').hide();
                }
                
                form.find('#fl-field-equal_height_box').show();

                if( carousal_type == 'all' ) {
                    form.find('#fl-field-total_posts').hide();
                } else {
                    form.find('#fl-field-total_posts').show();
                }

            } else if( is_carousel == 'feed' ) {
                form.find('#fl-builder-settings-section-carousel_filter').hide();
                form.find('#fl-builder-settings-section-grid_filter').hide();
                form.find('#fl-builder-settings-section-masonary_filter').hide();
                form.find('#fl-builder-settings-section-masonary_style').hide();
                form.find('#fl-builder-settings-section-masonary_select_style').hide();
                form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').hide();
                form.find('#fl-field-equal_height_box').hide();
                form.find('#fl-field-below_element_space').hide();

                form.find('#fl-builder-settings-section-pagination_setting').show();
                if( show_pagination == 'yes' && pagination == 'numbers' ) {
                    form.find('#fl-builder-settings-section-pagination_style').show();
                } else {
                    form.find('#fl-builder-settings-section-pagination_style').hide();
                }

                if( carousal_type == 'all' ) {
                    form.find('#fl-field-total_posts').hide();
                } else {
                    form.find('#fl-field-total_posts').show();
                }
            } else if( is_carousel == 'masonary' ) {
                
                form.find('#fl-builder-settings-section-carousel_filter').hide();
                form.find('#fl-builder-settings-section-grid_filter').show();
                form.find('#fl-field-equal_height_box').hide();
                form.find('#fl-field-post_per_grid_desktop').hide();
                form.find('#fl-field-below_element_space').show();
                form.find('#fl-field-post_per_grid').show();


                if ( form.find('.fl-loop-builder-'+post_type+'-masonary_filter').children().length > 0 ) {

                    form.find('#fl-builder-settings-section-masonary_filter').show();
                    form.find('.fl-loop-builder-masonary_filter').hide();
                    form.find('.fl-loop-builder-'+post_type+'-masonary_filter').show();
                    if( filter_type == 'drop-down' ) {
                        form.find('#fl-builder-settings-section-masonary_select_style').show();
                        form.find('#fl-builder-settings-section-masonary_style').hide();
                        form.find('#fl-field-taxonomy_filter_select_color').show();
                    }
                    else {
                        form.find('#fl-builder-settings-section-masonary_select_style').hide();
                        form.find('#fl-builder-settings-section-masonary_style').show();
                        form.find('#fl-field-taxonomy_filter_select_color').hide();
                    }
                    form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').show();
                    //form.find('#fl-builder-settings-section-pagination_setting').hide();
                    //form.find('#fl-builder-settings-section-pagination_style').hide();
                } else {
                    form.find('#fl-builder-settings-section-masonary_filter').hide();
                    form.find('#fl-builder-settings-section-masonary_style').hide();
                    form.find('#fl-builder-settings-section-masonary_select_style').hide();
                    form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').hide();
                }
            } else {
                form.find('#fl-builder-settings-section-carousel_filter').show();
                form.find('#fl-builder-settings-section-grid_filter').show();
                form.find('#fl-builder-settings-section-masonary_filter').hide();
                form.find('#fl-builder-settings-section-masonary_style').hide();
                form.find('#fl-builder-settings-section-masonary_select_style').hide();
                form.find('#fl-builder-settings-section-taxonomy_filter_select_field_typography').hide();
                form.find('#fl-field-equal_height_box').show();
                form.find('#fl-field-below_element_space').hide();
                form.find('#fl-field-post_per_grid_desktop').show();
                form.find('#fl-field-post_per_grid').hide();

                if( enable_arrow == 'yes' ) {
                    form.find('#fl-field-arrow_color').show();
                    form.find( '#fl-field-arrow_style' ).show();
                    form.find( '#fl-field-arrow_position' ).show();
                    if( arrow_style == 'square-border' || arrow_style == 'circle-border' ) {
                        form.find( '#fl-field-arrow_background_color' ).hide();
                        form.find( '#fl-field-arrow_background_color_opc' ).hide();

                        form.find( '#fl-field-arrow_color_border' ).show();
                        form.find( '#fl-field-arrow_border_size' ).show();
                    } else {
                        form.find( '#fl-field-arrow_background_color' ).show();
                        form.find( '#fl-field-arrow_background_color_opc' ).show();

                        form.find( '#fl-field-arrow_color_border' ).hide();
                        form.find( '#fl-field-arrow_border_size' ).hide();
                    }
                } else {
                    form.find('#fl-field-arrow_color').hide();
                    form.find( '#fl-field-arrow_style' ).hide();
                    form.find( '#fl-field-arrow_background_color' ).hide();
                    form.find( '#fl-field-arrow_background_color_opc' ).hide();
                    form.find( '#fl-field-arrow_color_border' ).hide();
                    form.find( '#fl-field-arrow_border_size' ).hide();
                    form.find( '#fl-field-arrow_position' ).hide();
                }

                form.find('#fl-builder-settings-section-pagination_setting').hide();
                form.find('#fl-builder-settings-section-pagination_style').hide();
            }
            if( show_pagination == 'yes' && pagination == 'scroll' && is_carousel != 'masonary' ) {
                form.find('#fl-field-total_posts').hide();
            }
            else {
                form.find('#fl-field-total_posts').show();
            }

        },
        /**
         * Branding is on hide the Docs Tab.
         *
         * @since 1.14.0
        */
        _hideDocs: function() {
            var form            = $('.fl-builder-settings'),
            branding_selector   = form.find('#fl-field-uabb_helpful_information .uabb-docs-list');
            settings_tab        = form.find('.fl-builder-settings-tabs');
            get_anchor          =  settings_tab.find('a');

            $( get_anchor ).each(function() {

                if ( '#fl-builder-settings-tab-uabb_docs' === $(this) .attr('href') ) {

                    if ( 'yes' === branding_selector.data('branding') ) {
                        $( this ).hide();
                    } else {
                        $( this ).show();
                    }
                }
            });
        },
        _selectionOrder: function() { 
            var form        = $('.fl-builder-settings');
            order_by = form.find('select[name=order_by]').val();
            
            if ( 'post__in' === order_by ) {
                form.find('#fl-field-order').hide();
            } else {
                form.find('#fl-field-order').show();
            }
        },
    });

})(jQuery);