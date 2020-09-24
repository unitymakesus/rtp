@php
  $directory_index = App\get_map_directory_index();
@endphp

<svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1082.7 977.4" style="enable-background:new 0 0 1082.7 977.4;" xml:space="preserve" class="boxyard-map-svg" aria-labelledby="mapDesc" tabindex="0">
  <desc id="mapDesc">
    @if ($desc = get_field('vendor_map_alternative_text'))
      {{ $desc }}
    @endif
  </desc>
  <style type="text/css">
    .st0{opacity:0.53;fill:url(#SVGID_1_);}
    .st1{fill:#FFFFFF;}
    .st2{fill:none;stroke:#9B9B9B;stroke-miterlimit:10;}
    .st3{opacity:0.2;fill:none;stroke:#000;stroke-width:2;stroke-miterlimit:10;}
    .st4{opacity:0.2;fill:none;stroke:#868989;stroke-width:3;stroke-miterlimit:10;}
    .st5{fill:#022D39;}
    .st6{fill:#BBBBBB;}
    .st7{fill:#BBBBBB;stroke:#040505;stroke-width:0.931;stroke-miterlimit:10;}
    .st8{fill:#908279;}
    .st9{fill:#CCCCCC;}
    .st10{fill:#E0E0DF;}
    .st11{fill:#033B4A;}
    .st12{fill:#FFFFFF;stroke:#040505;stroke-width:0.931;stroke-miterlimit:10;}
    .st13{clip-path:url(#SVGID_3_);}
    .st14{fill:#231F20;}
    .st15{fill:#040505;}
    .st16{clip-path:url(#SVGID_5_);}
    .st17{fill-rule:evenodd;clip-rule:evenodd;fill:#040505;}
    .st18{clip-path:url(#SVGID_7_);}
    .st19{clip-path:url(#SVGID_9_);}
    .st20{fill:#9B3014;}
    .st21{clip-path:url(#SVGID_11_);}
    .st22{clip-path:url(#SVGID_13_);}
    .st23{fill:#D6261F;}
    .st24{fill:#DD2521;}
    .st25{fill:#A88A72;}
    .st26{clip-path:url(#SVGID_16_);}
    .st27{clip-path:url(#SVGID_17_);}
    .st28{fill:#A4A7A9;}
    .st29{clip-path:url(#SVGID_20_);}
    .st30{clip-path:url(#SVGID_21_);}
    .st31{clip-path:url(#SVGID_24_);}
    .st32{clip-path:url(#SVGID_25_);}
    .st33{clip-path:url(#SVGID_27_);}
    .st34{clip-path:url(#SVGID_29_);}
    .st35{clip-path:url(#SVGID_31_);}
    .st36{clip-path:url(#SVGID_33_);}
    .st37{fill:none;stroke:#4EC8F1;stroke-width:2;stroke-miterlimit:10;}
    .st38{fill:none;stroke:#4EC8F1;stroke-width:2;stroke-miterlimit:10;stroke-dasharray:7.8644,7.8644;}
    .st39{opacity:0.7;fill:#E0E0DF;}
    .st40{fill:none;stroke:#4EC8F1;stroke-width:2;stroke-miterlimit:10;stroke-dasharray:8.0626,8.0626;}
    .st41{fill:#5A5B5C;}
    .st42{font-family:'Helvetica'; font-weight: 700;}
    .st43{font-size:36px;}
    .st44{opacity:0.7;}
    .st45{fill:url(#SVGID_34_);}
    .st46{fill:url(#SVGID_35_);}
    .st47{fill:url(#SVGID_36_);}
    .st48{opacity:0.7;fill:none;stroke:url(#SVGID_37_);stroke-miterlimit:10;}
    .st49{opacity:0.7;fill:none;stroke:url(#SVGID_38_);stroke-miterlimit:10;}
    .st50{opacity:0.7;fill:none;stroke:url(#SVGID_39_);stroke-miterlimit:10;}
    .st51{opacity:0.7;fill:none;stroke:url(#SVGID_40_);stroke-miterlimit:10;}
    .st52{opacity:0.7;fill:none;stroke:url(#SVGID_41_);stroke-miterlimit:10;}
    .st53{opacity:0.7;fill:none;stroke:url(#SVGID_42_);stroke-miterlimit:10;}
    .st54{opacity:0.7;fill:none;stroke:url(#SVGID_43_);stroke-miterlimit:10;}
    .st55{opacity:0.7;fill:none;stroke:url(#SVGID_44_);stroke-miterlimit:10;}
    .st56{opacity:0.7;fill:none;stroke:url(#SVGID_45_);stroke-miterlimit:10;}
    .st57{opacity:0.7;fill:none;stroke:url(#SVGID_46_);stroke-miterlimit:10;}
    .st58{opacity:0.7;fill:none;stroke:url(#SVGID_47_);stroke-miterlimit:10;}
    .st59{opacity:0.7;fill:none;stroke:url(#SVGID_48_);stroke-miterlimit:10;}
    .st60{opacity:0.7;fill:none;stroke:url(#SVGID_49_);stroke-miterlimit:10;}
    .st61{opacity:0.7;fill:none;stroke:url(#SVGID_50_);stroke-miterlimit:10;}
    .st62{opacity:0.7;fill:none;stroke:url(#SVGID_51_);stroke-miterlimit:10;}
    .st63{opacity:0.7;fill:none;stroke:url(#SVGID_52_);stroke-miterlimit:10;}
    .st64{opacity:0.7;fill:none;stroke:url(#SVGID_53_);stroke-miterlimit:10;}
    .st65{opacity:0.7;fill:none;stroke:url(#SVGID_54_);stroke-miterlimit:10;}
    .st66{opacity:0.7;fill:none;stroke:url(#SVGID_55_);stroke-miterlimit:10;}
    .st67{opacity:0.7;fill:none;stroke:url(#SVGID_56_);stroke-miterlimit:10;}
    .st68{opacity:0.7;fill:none;stroke:url(#SVGID_57_);stroke-miterlimit:10;}
    .st69{opacity:0.7;fill:none;stroke:url(#SVGID_58_);stroke-miterlimit:10;}
    .st70{clip-path:url(#SVGID_60_);}
    .st71{clip-path:url(#SVGID_62_);fill:#231F20;}
    .st72{opacity:0.7;fill:url(#SVGID_63_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st73{opacity:0.7;fill:url(#SVGID_64_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st74{opacity:0.7;fill:url(#SVGID_65_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st75{opacity:0.7;fill:url(#SVGID_66_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st76{opacity:0.7;fill:url(#SVGID_67_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st77{opacity:0.7;fill:url(#SVGID_68_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st78{opacity:0.7;fill:url(#SVGID_69_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st79{opacity:0.7;fill:url(#SVGID_70_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st80{opacity:0.7;fill:url(#SVGID_71_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st81{opacity:0.7;fill:url(#SVGID_72_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st82{opacity:0.7;fill:url(#SVGID_73_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st83{opacity:0.7;fill:url(#SVGID_74_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st84{opacity:0.7;fill:url(#SVGID_75_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st85{opacity:0.7;fill:url(#SVGID_76_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st86{opacity:0.7;fill:url(#SVGID_77_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st87{opacity:0.7;fill:url(#SVGID_78_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st88{opacity:0.7;fill:url(#SVGID_79_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st89{opacity:0.7;fill:url(#SVGID_80_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st90{opacity:0.7;fill:url(#SVGID_81_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st91{opacity:0.7;fill:url(#SVGID_82_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st92{opacity:0.7;fill:url(#SVGID_83_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st93{opacity:0.7;fill:url(#SVGID_84_);stroke:#FFFFFF;stroke-miterlimit:10;}
    .st94{font-size:54px;}
  </style>
  <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="486.2743" y1="400.9359" x2="872.8243" y2="1019.5452">
    <stop  offset="0.21" style="stop-color:#FFFFFF"/>
    <stop  offset="0.4434" style="stop-color:#9FB7A1"/>
    <stop  offset="0.6817" style="stop-color:#98B29A"/>
  </linearGradient>
  <rect x="-0.7" y="-1.2" class="st0" width="1082.7" height="978.4"/>
  <path class="st1" d="M270.2,761.5l-4.9,14.8l26.7-2.1l102-61.3l45.3,26.1l47.4-28l19.6,11.4l50.2-28.7l239.3,141l44.1-2l4.2-25.4
    L626.4,679.4l130.4-74.8l211.8,122.3l17.3,1.4V717L768.2,594.1l0,0L580.8,484.6L337.2,622l41.5,24.2l-49,29.3l43.6,24.8L270.2,761.5
    z"/>
  <path class="st2" d="M269.7,761.6l-4.9,14.8l26.7-2.1"/>
  <g>
    <line class="st3" x1="322.1" y1="664.9" x2="470.1" y2="752.1"/>
    <line class="st3" x1="477.4" y1="748" x2="329.4" y2="660.7"/>
    <line class="st3" x1="484.7" y1="743.8" x2="336.7" y2="656.6"/>
    <line class="st3" x1="491.9" y1="739.6" x2="343.9" y2="652.4"/>
    <line class="st3" x1="499.2" y1="735.4" x2="351.2" y2="648.3"/>
    <line class="st3" x1="506.4" y1="731.3" x2="358.5" y2="644.1"/>
    <line class="st3" x1="513.7" y1="727.1" x2="365.8" y2="640"/>
    <line class="st3" x1="521" y1="722.9" x2="373.1" y2="635.8"/>
    <line class="st3" x1="528.2" y1="718.8" x2="380.4" y2="631.7"/>
    <line class="st3" x1="535.5" y1="714.6" x2="387.6" y2="627.5"/>
    <line class="st3" x1="542.7" y1="710.4" x2="394.9" y2="623.4"/>
    <line class="st3" x1="550" y1="706.2" x2="402.2" y2="619.2"/>
    <line class="st3" x1="557.2" y1="702.1" x2="409.5" y2="615.1"/>
    <line class="st3" x1="564.5" y1="697.9" x2="416.8" y2="611"/>
    <line class="st3" x1="571.8" y1="693.7" x2="424.1" y2="606.8"/>
    <line class="st3" x1="579" y1="689.5" x2="431.3" y2="602.7"/>
    <line class="st3" x1="586.3" y1="685.4" x2="438.6" y2="598.5"/>
    <line class="st3" x1="593.5" y1="681.2" x2="445.9" y2="594.4"/>
    <line class="st3" x1="600.8" y1="677" x2="453.2" y2="590.2"/>
    <line class="st3" x1="608" y1="672.9" x2="460.5" y2="586.1"/>
    <line class="st3" x1="615.3" y1="668.7" x2="467.8" y2="581.9"/>
    <line class="st3" x1="622.6" y1="664.5" x2="475" y2="577.8"/>
    <line class="st3" x1="629.8" y1="660.3" x2="482.3" y2="573.6"/>
    <line class="st3" x1="637.1" y1="656.2" x2="489.6" y2="569.5"/>
    <line class="st3" x1="644.3" y1="652" x2="496.9" y2="565.3"/>
    <line class="st3" x1="651.6" y1="647.8" x2="504.2" y2="561.2"/>
    <line class="st3" x1="658.8" y1="643.6" x2="511.4" y2="557"/>
    <line class="st3" x1="666.1" y1="639.5" x2="518.7" y2="552.9"/>
    <line class="st3" x1="673.4" y1="635.3" x2="526" y2="548.7"/>
    <line class="st3" x1="680.6" y1="631.1" x2="533.3" y2="544.6"/>
    <line class="st3" x1="687.9" y1="626.9" x2="540.6" y2="540.5"/>
    <line class="st3" x1="695.1" y1="622.8" x2="547.9" y2="536.3"/>
    <line class="st3" x1="702.4" y1="618.6" x2="555.1" y2="532.2"/>
    <line class="st3" x1="709.7" y1="614.4" x2="562.4" y2="528"/>
    <line class="st3" x1="716.9" y1="610.3" x2="569.7" y2="523.9"/>
    <line class="st3" x1="724.2" y1="606.1" x2="577" y2="519.7"/>
    <line class="st3" x1="731.4" y1="601.9" x2="584.3" y2="515.6"/>
  </g>
  <g>
    <line class="st4" x1="324.6" y1="656.8" x2="472.7" y2="744.1"/>
  </g>
  <g transform="translate(-591.074 -561.737)">
    <path class="st6" d="M1184.3,1334l-106.5-61.4l-47.4,28l107,61.7L1184.3,1334z"/>
    <g>
      <path class="st1" d="M1030.4,1300.6l47.4-28l106.5,61.4l-47,28.4L1030.4,1300.6z"/>
      <path class="st6" d="M1258.6,1022.8l-80.2,45.8l128.2,74.9l80.4-46.2L1258.6,1022.8z"/>
      <path class="st6" d="M1407.8,1109.8l-20.9-12.5l-80.4,46.2l20.1,11.5L1407.8,1109.8z"/>
      <path class="st7" d="M1281.8,1204.2l-48.3,27.7"/>
      <path class="st7" d="M1340.1,1294.6l48.7-28.2"/>
    </g>
    <path class="st6" d="M1258.6,1022.8l-80.2,45.8l128.2,74.9l80.4-46.2L1258.6,1022.8z"/>
    <path class="st6" d="M1407.8,1109.8l-20.9-12.5l-80.4,46.2l20.1,11.5L1407.8,1109.8z"/>
    <path class="st1" d="M1464.1,1077.9l-120.4,67.9l21.6,12.3l120.4-67.5v-12.8L1464.1,1077.9z"/>
    <path class="st8" d="M1466.5,1234.8l-11.5-6.8l-130.9,75.9l11.8,6.8L1466.5,1234.8z"/>
    <path class="st8" d="M1188,1346.8l20.4,12.1l57.8-33.5l-12.4-7.7l-48.8,28.3l-20.6-11.9l-47,28.4l14.2,7.3L1188,1346.8z"/>
    <path class="st8" d="M1137.3,1362.3l-17.1,10.4l-67.2-38.5l-13.5,7.3l-84.2-49.3l29.3-17.5L1137.3,1362.3z"/>
    <path class="st8" d="M920.2,1237.4l43.6,24.8l-32.2,19.1l-85.8-49.4l31.9-19.1L920.2,1237.4z"/>
    <path class="st8" d="M1407.8,1109.8l8.5-5l-157.8-92.2l-75.6,40.8l10.9,6.3l64.6-36.8L1407.8,1109.8z"/>
    <path class="st8" d="M812.5,1175l51.4-28.8l0,0l-19.2-11.2l101.6-57.8l-15.5-8.6l-114,62.7l23.2,13.4l-40.7,22.4L812.5,1175z"/>
    <path class="st6" d="M1152.5,1105.9l-20-11.8l33.9-18.8l-22.4-13.1l-33.5,19l-19.5-11.5l-40.1,22.5l19.7,11.6l-32.2,17.8l20.8,12.4
      l32.6-17.7l20.5,12.1L1152.5,1105.9z"/>
    <path class="st6" d="M1258.6,1022.8l-80.2,45.8l128.2,74.9l80.4-46.2L1258.6,1022.8z"/>
    <path class="st6" d="M1407.8,1109.8l-20.9-12.5l-80.4,46.2l20.1,11.5L1407.8,1109.8z"/>
    <path class="st6" d="M812.5,1175l51.4-28.7l105.8,61.8l-49.5,29.3L812.5,1175z"/>
    <polygon class="st6" points="1266.1,1213.2 1217.5,1241.1 1324.2,1303.8 1372.8,1275.7 	"/>
    <path class="st6" d="M951.7,1197.6l49-29l-106.6-61.7l-49.4,28.1L951.7,1197.6z"/>
    <path class="st9" d="M1052.2,1139.4l-105.9-62.2l-52.1,29.7l106.6,61.7L1052.2,1139.4z"/>
    <path class="st6" d="M1253.8,1317.6l-106.2-62.3l-16.4,9.3l106.4,62.3L1253.8,1317.6z"/>
    <path class="st6" d="M1204.9,1345.9l16-9.3l-106.9-62.1l-16.6,9.5L1204.9,1345.9z"/>
    <path class="st6" d="M1237.5,1327l-106.4-62.3l-17.1,9.8l106.9,62.1L1237.5,1327z"/>
    <g>
      <g>
        <path class="st1" d="M1112.7,1118.7l-20.4-12l-0.1-0.1l-0.1,0.1l-32.5,17.6l-20.3-12.1l31.8-17.6l0.4-0.2l-0.4-0.2l-19.3-11.4
          l39.6-22.2l19.4,11.4l0.1,0.1l0.1-0.1l33.4-18.9l21.9,12.8l-33.6,18.6l-0.4,0.2l0.4,0.2l19.6,11.6L1112.7,1118.7z"/>
        <path class="st10" d="M1112.7,1118.4l39.1-21.9l-19.2-11.3l-0.8-0.4l0.8-0.4l33.2-18.4l-21.4-12.5l-33.3,18.8l-0.3,0.1l-0.2-0.1
          l-19.2-11.3l-39.1,21.9l19,11.2l0.7,0.4l-0.8,0.4l-31.4,17.4l19.8,11.8l32.4-17.5l0.2-0.1l0.2,0.1L1112.7,1118.4 M1112.7,1119
          l-20.5-12.1l-32.6,17.7l-20.8-12.4l32.2-17.8l-19.7-11.6l40.1-22.5l19.5,11.5l33.5-19l22.4,13.1l-33.9,18.8l20,11.8L1112.7,1119z
          "/>
        <path class="st10" d="M1140.8,1089.4l26-14.4v-9.1l-33.9,18.8L1140.8,1089.4z"/>
        <path class="st10" d="M1112.7,1119l-20.5-12.1l-32.6,17.7l-20.8-12.4v9.1l20.8,12.4l32.6-17.7l20.5,12.1l40.1-22.5v-9.1
          L1112.7,1119z"/>
        <path class="st10" d="M1051.2,1082.7v9.1l11.9,7l7.9-4.5L1051.2,1082.7z"/>
      </g>
    </g>
    <g class="suite {{ $directory_index['125']['category'] ?? '' }}" id="suite-125" data-vendor="{{ $directory_index['125']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['125']['name'] ?? '' }}">
      <path class="wall" d="M1306.6,1143.5"/>
      <path class="wall" d="M1306.5,1074.9"/>
      <path class="wall" d="M1178.3,1034.1l128.2,75.2v34.2l-128.2-74.9V1034.1z"/>
      <g transform="translate(0 34)">
        <g>
          <polygon class="roof" points="1178.8,1000.1 1258.4,954.9 1386.1,1030.1 1306.6,1075 				"/>
          <path class="wall" d="M1258.4,955.2l127.1,74.8l-79,44.6l-127.2-74.6L1258.4,955.2 M1258.4,954.6l-80.1,45.4l128.2,75.2l80-45.2
            L1258.4,954.6L1258.4,954.6z"/>
        </g>
      </g>
    </g>
    <g class="suite {{ $directory_index['140']['category'] ?? '' }}" id="suite-140" data-vendor="{{ $directory_index['140']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['140']['name'] ?? '' }}">
      <polygon class="roof stroke-highlight" points="1307.1,1109.3 1386.6,1064.4 1407,1075.3 1326.5,1120.8 "/>
      <path class="wall stroke-highlight" d="M1306.6,1109.3l20,11.8l0.1,34l-20.1-11.5V1109.3z"/>
      <path class="wall stroke-highlight" d="M1326.5,1121.1l81-45.7l0.3,34.5l-81.2,45.2L1326.5,1121.1z"/>
    </g>
    <g>
      <path class="st1" d="M1388.8,1266.4l15.3-8.8l51-29.6v-33.4l-66.2,37.5 M1388.9,1232.2l66.2-37.5v33.4l-51,29.6l-15.3,8.8"/>
      <polygon class="st10" points="1404.1,1223.7 1404.1,1257.6 1455.1,1228 1455.1,1194.6 		"/>
    </g>
    <g transform="translate(0 35)">
      <g>
        <polygon class="st1" points="1297.9,1125.9 1347.9,1099.1 1454.6,1159.6 1404.1,1188.4 			"/>
        <path class="st10" d="M1347.9,1099.3l106.2,60.3l-50,28.5l-105.7-62.2L1347.9,1099.3 M1347.9,1098.8l-50.5,27.1l106.7,62.8l51-29
          L1347.9,1098.8L1347.9,1098.8z"/>
      </g>
      <path class="st12" d="M1453.6,1229"/>
    </g>
    <g transform="translate(0 35)">
      <g>
        <g>
          <defs>
            <polygon id="SVGID_2_" points="1353.7,1149.2 1385.5,1167.5 1417.8,1148.8 1386.1,1130.6 					"/>
          </defs>
          <clipPath id="SVGID_3_">
            <use xlink:href="#SVGID_2_"  style="overflow:visible;"/>
          </clipPath>
          <g class="st13">
            <path class="st14" d="M1385.5,1167.5l-31.7-18.2l32.4-18.7l31.7,18.2L1385.5,1167.5z M1355.8,1149.2l29.7,17.1l30.3-17.5
              l-29.7-17.1L1355.8,1149.2z"/>
          </g>
        </g>
      </g>
      <path class="st15" d="M1393,1152.3c1,0.5,2.1,0.5,3.1,0c0.5-0.2,0.8-0.7,0.6-1.2c-0.1-0.3-0.3-0.5-0.6-0.6c-1-0.5-2.1-0.5-3.1,0
        c-0.5,0.2-0.8,0.7-0.6,1.2C1392.5,1152,1392.7,1152.2,1393,1152.3z"/>
      <path class="st15" d="M1389.8,1161.3l3.1-2.1l-0.6-1.5l-2.6-1.5l3.2-2.8c0.3-0.2,0.2-0.5-0.2-0.7c-0.4-0.2-0.8-0.1-1.2,0.1l-1,0.8
        l0,0c-2.1-0.3-4.2-0.1-6.2,0.6c-1.6,0.6-2.6,1.6-2.8,2.6c-0.2,1.2,0.7,2.6,2.5,3.6c0.1,0.1,0.3,0.2,0.4,0.2c0.4,0.2,0.8,0.2,1.2,0
        c0.3-0.2,0.3-0.5-0.1-0.7c-1.6-0.8-2.6-2-2.4-3c0.1-0.7,0.9-1.4,2-1.9c1.3-0.5,2.8-0.7,4.2-0.5l-2,1.7l3.2,1.9l0.3,0.7l-2.5,1.7
        c-0.3,0.2-0.3,0.5,0,0.7l0,0C1389,1161.5,1389.5,1161.5,1389.8,1161.3z"/>
      <path class="st15" d="M1374.2,1154.9c-0.3-0.2-0.3-0.5,0-0.7l5.8-3.4l1.5,0.9l1.5,0l6.4-4.9l-1.9-1.1l-7.7,2.8
        c-0.4,0.1-0.8,0.1-1.2-0.1c-0.3-0.2-0.1-0.5,0.3-0.7l8.1-3c0.5-0.2,1-0.1,1.4,0.1l3.3,1.9l-7.9,6l-3-0.1l-0.8-0.4l-4.5,2.7
        C1375.1,1155.1,1374.6,1155.1,1374.2,1154.9L1374.2,1154.9z"/>
      <path class="st15" d="M1393.9,1145.1c-1.1,0.6-2.4,0.6-3.5,0c-0.6-0.2-0.9-0.8-0.7-1.3c0.1-0.3,0.4-0.6,0.7-0.7
        c1.1-0.6,2.4-0.6,3.5,0c0.6,0.2,0.9,0.8,0.7,1.3C1394.5,1144.7,1394.2,1145,1393.9,1145.1"/>
      <path class="st15" d="M1365.9,1149.6L1365.9,1149.6c-0.2-0.1-0.3-0.3-0.2-0.5c0-0.1,0.1-0.2,0.2-0.2l4.7-2.6l-0.5-1.8l8.7-5
        l4.3,2.5c0.4,0.2,0.4,0.6,0.1,0.8l0,0l-6.8,4c-0.4,0.2-0.8,0.2-1.2,0l0,0c-0.2-0.1-0.3-0.3-0.2-0.5c0-0.1,0.1-0.2,0.2-0.2l6.4-3.7
        l-2.6-1.5l-6.9,4l0.5,1.8l-5.3,3C1366.8,1149.8,1366.3,1149.8,1365.9,1149.6z"/>
      <path class="st15" d="M1385.4,1140.4c-1.1,0.6-2.4,0.6-3.5,0c-0.6-0.2-0.9-0.8-0.7-1.3c0.1-0.3,0.4-0.6,0.7-0.7
        c1.1-0.6,2.4-0.6,3.5,0c0.6,0.2,0.9,0.8,0.7,1.3C1386,1140.1,1385.7,1140.3,1385.4,1140.4"/>
    </g>
    <g transform="translate(0 35)">
      <g>
        <g>
          <defs>
            <polygon id="SVGID_4_" points="1313.6,1126.7 1345.6,1144.7 1377.6,1125.8 1345.6,1107.8 					"/>
          </defs>
          <clipPath id="SVGID_5_">
            <use xlink:href="#SVGID_4_"  style="overflow:visible;"/>
          </clipPath>
          <g class="st16">
            <path class="st14" d="M1345.6,1144.7l-32-18l32-18.9l32,18L1345.6,1144.7z M1315.6,1126.7l29.9,16.9l30-17.7l-29.9-16.9
              L1315.6,1126.7z"/>
          </g>
        </g>
      </g>
      <path class="st17" d="M1335.7,1122.3l0.1,3.4l0,0l5.9-0.1l1.4-0.8l-4.9,0l6.8-4l-1-0.6l-6.8,4l-0.1-2.8L1335.7,1122.3z"/>
      <path class="st17" d="M1354.4,1129.2l-0.1-3.4l0,0l-5.9,0.1l-1.4,0.8l4.9,0l-6.8,4l1,0.6l6.8-4l0.1,2.8L1354.4,1129.2z"/>
      <g>
        <g>
          <defs>
            <polygon id="SVGID_6_" points="1325.1,1126.1 1345.8,1137.7 1365.8,1125.8 1345.1,1114.2 					"/>
          </defs>
          <clipPath id="SVGID_7_">
            <use xlink:href="#SVGID_6_"  style="overflow:visible;"/>
          </clipPath>
          <g class="st18">
            <path class="st15" d="M1343,1136.2l-15.1-8.5c-1.5-0.9-1.6-2.3-0.1-3.2l14.6-8.7c1.7-0.9,3.7-0.9,5.5-0.1l15.1,8.5
              c1.5,0.8,1.6,2.3,0.1,3.1l-14.7,8.8C1346.7,1137,1344.7,1137,1343,1136.2z M1346.7,1116.4c-1-0.5-2.2-0.5-3.2,0l-14.6,8.7
              c-0.9,0.5-0.8,1.3,0.1,1.8l15.1,8.5c1,0.5,2.2,0.5,3.2,0l14.7-8.8c0.9-0.5,0.8-1.3-0.1-1.8L1346.7,1116.4z"/>
          </g>
        </g>
      </g>
      <g>
        <g>
          <defs>
            <polygon id="SVGID_8_" points="1334.8,1131.1 1336,1131.7 1355.2,1120.2 1354.1,1119.6 					"/>
          </defs>
          <clipPath id="SVGID_9_">
            <use xlink:href="#SVGID_8_"  style="overflow:visible;"/>
          </clipPath>
          <g class="st19">
            <path class="st15" d="M1336,1131.7l-1.1-0.6l19.3-11.5l1.1,0.6L1336,1131.7z"/>
          </g>
        </g>
      </g>
    </g>
    <g class="suite {{ $directory_index['120']['category'] ?? '' }}" id="suite-120" data-vendor="{{ $directory_index['120']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['120']['name'] ?? '' }}">
      <path class="wall" d="M1000.8,1134.4L895,1072.5l-0.9,34.4l106.7,61.6L1000.8,1134.4z"/>
      <path class="wall" d="M1051.8,1105.3l-51,29.1L895,1072.5l-0.9,34.4l106.7,61.6l51.4-29.1L1051.8,1105.3z"/>
      <polygon class="roof" points="895.5,1072.5 945.3,1043.9 1051.3,1105.3 1000.8,1134.1"/>
      <path class="wall" d="M945.3,1044.2l105.5,61.1l-50,28.5L896,1072.6L945.3,1044.2 M945.3,1043.7l-50.3,28.9l105.8,61.9l51-29.1 L945.3,1043.7L945.3,1043.7z"/>
    </g>
    <g>
      <g class="suite {{ $directory_index['145']['category'] ?? '' }} popbox" id="suite-145" data-vendor="{{ $directory_index['145']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['145']['name'] ?? '' }}">
        <polygon class="wall" points="1281.8,1169.4 1281.8,1204.2 1388.8,1266.4 1388.9,1232.1 	"/>
        <path class="wall" d="M1388.8,1266.4l15.3-8.8l-106.3-62.5l-16.1,9.1"/>
        <path class="wall" d="M1297.4,1160.9l-15.6,8.5l0,34.8l16.1-9.1L1297.4,1160.9z"/>
        <polygon class="roof" points="1282.3,1169.4 1297.4,1161.2 1403.6,1223.7 1388.9,1231.9"/>
        <polygon class="wall stroke-highlight" points="1404.1,1223.7 1388.9,1232.2 1388.8,1266.4 1404.1,1257.6"/>
      </g>
      <g class="suite {{ $directory_index['150']['category'] ?? '' }}" id="suite-150" data-vendor="{{ $directory_index['150']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['150']['name'] ?? '' }}">
        <path class="wall" d="M1266.1,1213.2v-34.6l107,62.8l-0.3,34.3L1266.1,1213.2z"/>
        <path class="wall stroke-highlight" d="M1388.9,1232.2l-15.8,9.2l-0.3,34.3l15.9-9.3L1388.9,1232.2z"/>
        <polygon class="roof" points="1266.6,1178.6 1281.8,1169.7 1388.4,1232.2 1373.1,1241.1"/>
        <path class="wall" d="M1281.8,1170l106.1,62.2l-14.8,8.7l-106-62.2L1281.8,1170 M1281.8,1169.4l-15.6,9.2l107,62.8l15.8-9.2 L1281.8,1169.4L1281.8,1169.4z"/>
      </g>
    </g>
    <g class="suite {{ $directory_index['105']['category'] ?? '' }}" id="suite-105" data-vendor="{{ $directory_index['105']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['105']['name'] ?? '' }}">
      <polygon class="roof" points="845.1,1101.2 895,1072.8 1000.3,1134.4 951.8,1162.8"/>
      <path class="wall" d="M895,1073.1l104.8,61.3l-48,28.1l-106.2-61.3L895,1073.1 M895,1072.5l-50.3,28.7l107.2,61.9l49-28.7 L895,1072.5L895,1072.5z"/>
      <path class="wall" d="M1000.8,1134.4l-49,28.7l-107.2-61.9v33.8l107,62.5l49-29L1000.8,1134.4z"/>
    </g>
    <g class="suite {{ $directory_index['100']['category'] ?? '' }}" id="suite-100" data-vendor="{{ $directory_index['100']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['100']['name'] ?? '' }}">
      <path class="wall" d="M969.7,1173.3l-49.5,29.3l-107.7-61.9v34.2l107.7,62.4l49.5-29.4V1173.3z"/>
      <polygon class="roof" points="813,1140.8 863,1112.1 969.2,1173.3 920.2,1202.4"/>
      <path class="wall" d="M863,1112.4l105.7,60.9l-48.5,28.8l-106.7-61.3L863,1112.4 M863,1111.8l-50.5,29l107.7,61.9l49.5-29.4 L863,1111.8L863,1111.8z"/>
    </g>
    <g transform="translate(-1)">
      <g>
        <g>
          <defs>
            <polygon id="SVGID_10_" points="1052.8,1139.6 1083.5,1158.1 1083.5,1126.6 1052.8,1108.1 					"/>
          </defs>
          <clipPath id="SVGID_11_">
            <use xlink:href="#SVGID_10_"  style="overflow:visible;"/>
          </clipPath>
          <g class="st21">
            <path class="st14" d="M1083.5,1158.1l-30.7-18.5v-31.5l30.7,18.5V1158.1z"/>
          </g>
        </g>
      </g>
      <path class="st1" d="M1082.4,1156.3l-28.5-17.2v-29.3l28.5,17.2V1156.3z"/>
      <path class="st15" d="M1072.8,1127.3v5.3l-5.3-3.2v5.2l-5.2-3.2v5.3l-4.7-2.8v1.3l5.9,3.5l0.1,0v-5.3l5.1,3.1l0.2,0.1v-5.2
        l5.3,3.2l0.1,0v-5.3l4.7,2.8v-1.3L1072.8,1127.3z"/>
    </g>
    <g transform="translate(20 -12)">
      <g transform="translate(1179.253 688.485)">
        <g>
          <defs>
            <polygon id="SVGID_12_" points="208.6,433.3 240.9,415.1 240.4,383.6 208.3,401.4 					"/>
          </defs>
          <clipPath id="SVGID_13_">
            <use xlink:href="#SVGID_12_"  style="overflow:visible;"/>
          </clipPath>
          <g class="st22">
            <path class="st14" d="M240.9,415.1l-32.3,18.2l-0.3-31.9l32.2-17.8L240.9,415.1z"/>
          </g>
        </g>
      </g>
      <path class="st1" d="M1418.8,1103.2l-30,16.5l-0.3-29.3l30-16.5L1418.8,1103.2z"/>
      <path class="st15" d="M1408.8,1085.5v5.3l-5.7,3.1v5.2l-5.6,3v5.3l-5,2.7v1.3l6.3-3.4l0.1,0v-5.3l5.4-2.9l0.2-0.1v-5.2l5.6-3.1
        l0.1,0v-5.3l5-2.7v-1.3L1408.8,1085.5z"/>
    </g>
    <g>
      <g class="suite {{ $directory_index['160']['category'] ?? '' }}" id="suite-160" data-vendor="{{ $directory_index['160']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['160']['name'] ?? '' }}">
        <path class="wall stroke-none" d="M1237.5,1292.8l-106.3-62l-0.1,33.9l106.4,62.3L1237.5,1292.8z"/>
        <path class="wall stroke-highlight" d="M1237.5,1292.8l16.2-9.4v34.2l-16.2,9.4V1292.8z"/>
        <polygon class="roof stroke-highlight" points="1131.8,1230.7 1148,1221.5 1253.3,1283.4 1237.6,1292.5"/>
        <path class="wall stroke-none" d="M1148,1221.8l104.8,61.6l-15.2,8.8l-105.3-61.4L1148,1221.8 M1148,1221.2l-16.7,9.5l106.3,62l16.2-9.4 L1148,1221.2L1148,1221.2z"/>
      </g>
      <g class="suite {{ $directory_index['165']['category'] ?? '' }}" id="suite-165" data-vendor="{{ $directory_index['165']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['165']['name'] ?? '' }}">
        <path class="wall stroke-highlight" d="M1220.9,1302.4l16.6-9.6v34.2l-16.6,9.6V1302.4z"/>
        <polygon class="roof stroke-highlight" points="1114.6,1240.4 1131.3,1231 1237.1,1292.8 1220.9,1302.1"/>
        <path class="wall" d="M1131.3,1231.3l105.3,61.5l-15.6,9l-105.8-61.4L1131.3,1231.3 M1131.3,1230.7l-17.2,9.7l106.8,61.9 l16.6-9.6L1131.3,1230.7L1131.3,1230.7z"/>
      </g>
      <g class="suite {{ $directory_index['170']['category'] ?? '' }}" id="suite-170" data-vendor="{{ $directory_index['170']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['170']['name'] ?? '' }}">
        <path class="wall" d="M1114,1274.5l-16.6,9.5l0.3-34.2l16.4-9.4L1114,1274.5z"/>
        <path class="wall stroke-highlight" d="M1220.9,1302.4l-16,9.3v34.2l16-9.3V1302.4z"/>
        <polygon class="roof stroke-highlight" points="1098.2,1249.8 1114.1,1240.7 1220.4,1302.4 1204.9,1311.4"/>
        <path class="wall stroke-highlight" d="M1204.9,1311.7l-107.2-61.9l-0.3,34.2l107.5,61.9V1311.7z"/>
      </g>
      <g class="suite {{ $directory_index['175']['category'] ?? '' }}" id="suite-175" data-vendor="{{ $directory_index['175']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['175']['name'] ?? '' }}">
        <path class="wall" d="M1184.5,1300.4l-47.2,27.5l0,34.4l47-28.4L1184.5,1300.4z"/>
        <polygon class="roof" points="1030.7,1266.2 1078,1238.6 1184.4,1300.2 1137.4,1327.7"/>
        <path class="wall" d="M1078,1238.9l105.9,61.2l-46.5,27.2l-106.2-61.2L1078,1238.9 M1078,1238.3l-47.8,27.9l107.2,61.7l47.5-27.8 L1078,1238.3L1078,1238.3z"/>
        <path class="wall" d="M1137.4,1327.9l-107.2-61.7l0.2,34.4l107,61.7L1137.4,1327.9z"/>
      </g>
    </g>
    <path class="st5" d="M1281.8,1204.2l0-34.8"/>
    <path class="st5" d="M1281.8,1169.4l0,34.8"/>
    <path class="st5" d="M1281.8,1204.2l0-34.8"/>
    <path class="st1" d="M1347.9,752.7l-49.3,28.3l105.5,60.8l49.5-28L1347.9,752.7z"/>
  </g>
  <g transform="translate(-607.937 -530.245)">
    <g>
      <path class="st25" d="M1340.2,893.7l130.3-74.5l-105.6-60.9l15.6-8.9l-21.3-12.6l63.2-38.5l-147-84.8l-63.6,36.9l-22.4-13
        l-145.8,82.2l-85-49.3l-96.7,55.6l20.4,12L833.1,767l106.1,60.3l30.5-18.6l106.9,65l-29.1,16.6l105.2,61.3l48.1-26.7l20.3,11.9
        l49.3-27.3l-84.3-50.7l47.8-27.5L1340.2,893.7z M1113.3,875.9l-145.5-87.5l96.5-56.9l131.6-71.9l147.2,86.3l-130.7,72.8
        L1113.3,875.9z"/>
    </g>
    <path class="st6" d="M1405.5,856.2l-105.6-61.1l-32.3,18.8l105.7,60.8L1405.5,856.2z"/>
    <path class="st6" d="M1275.4,613.4l-48.8,28.2l106,61.6l48.5-28.6L1275.4,613.4z"/>
    <path class="st6" d="M1146,881.2l49,28.2L1088.8,971l-48.7-28.6L1146,881.2z"/>
    <path class="st6" d="M976.5,719.6l-51.7-29.9l-32,18.4l51.7,29.3L976.5,719.6z"/>
    <path class="st6" d="M993.6,710.3L941.7,680l-16.8,9.7l51.7,29.9L993.6,710.3z"/>
    <g>
      <g>
        <defs>
          <polygon id="SVGID_14_" points="190.8,-63.3 191.8,-63.3 190.8,-62.3 				"/>
        </defs>
        <defs>
          <polygon id="SVGID_15_" points="188.8,-65.3 187.8,-65.3 188.8,-66.3 				"/>
        </defs>
        <clipPath id="SVGID_16_">
          <use xlink:href="#SVGID_14_"  style="overflow:visible;"/>
        </clipPath>
        <clipPath id="SVGID_17_" class="st26">
          <use xlink:href="#SVGID_15_"  style="overflow:visible;"/>
        </clipPath>
        <g class="st27">
          <path class="st28" d="M986.4,594.9l-27.9-16.3v-28.6l27.9,16.3V594.9z M959.3,578.2l26.1,15.3v-26.8l-26.1-15.3V578.2z"/>
        </g>
      </g>
    </g>
    <g>
      <g>
        <defs>
          <polygon id="SVGID_18_" points="190.8,-63.3 191.8,-63.3 190.8,-62.3 				"/>
        </defs>
        <defs>
          <polygon id="SVGID_19_" points="188.8,-65.3 187.8,-65.3 188.8,-66.3 				"/>
        </defs>
        <clipPath id="SVGID_20_">
          <use xlink:href="#SVGID_18_"  style="overflow:visible;"/>
        </clipPath>
        <clipPath id="SVGID_21_" class="st29">
          <use xlink:href="#SVGID_19_"  style="overflow:visible;"/>
        </clipPath>
        <g class="st30">
          <path class="st28" d="M1235,797.2l-27.9-16.8v-28.6l27.9,16.8V797.2z M1208,780.1l26.1,15.7V769l-26.1-15.7V780.1z"/>
        </g>
      </g>
    </g>
    <g>
      <g>
        <defs>
          <polygon id="SVGID_22_" points="190.8,-63.3 191.8,-63.3 190.8,-62.3 				"/>
        </defs>
        <defs>
          <polygon id="SVGID_23_" points="188.8,-65.3 187.8,-65.3 188.8,-66.3 				"/>
        </defs>
        <clipPath id="SVGID_24_">
          <use xlink:href="#SVGID_22_"  style="overflow:visible;"/>
        </clipPath>
        <clipPath id="SVGID_25_" class="st31">
          <use xlink:href="#SVGID_23_"  style="overflow:visible;"/>
        </clipPath>
        <g class="st32">
          <path class="st28" d="M1395.2,581.5l-27.9,17.4v-28.6l27.9-17.4L1395.2,581.5z M1368.2,597.5l26.1-16.3v-26.8l-26.1,16.3
            L1368.2,597.5z"/>
        </g>
      </g>
    </g>
    <g>
      <path class="st15" d="M1403,710.1v-30.6l29.6-18.1V692L1403,710.1z"/>
    </g>
    <g transform="translate(0 32)">
      <g>
        <path class="st1" d="M1316,717.4l48.8-28c3.3,1.9,70.7,40.8,105.2,60.7l-49,27.7L1316,717.4z"/>
        <path class="st10" d="M1364.8,689.7c4.6,2.6,70.4,40.6,104.7,60.4l-48.5,27.5l-104.5-60.2L1364.8,689.7 M1364.8,689.2l-49.3,28.3
          l105.5,60.8l49.5-28C1435.2,729.8,1364.8,689.2,1364.8,689.2L1364.8,689.2z"/>
      </g>
      <g transform="translate(0 -32)">
        <path class="st10" d="M1470.5,782.2l-49.5,28l0.2,37.1l49.3-28.2V782.2"/>
      </g>
      <g transform="translate(0 -32)">
        <path class="st10" d="M1315.5,749.4l105.5,60.8l0.2,37.1l-105.7-61.1V749.4z"/>
      </g>
      <g transform="translate(0 35)">
        <g>
          <g>
            <defs>
              <polygon id="SVGID_26_" points="1370.6,704.5 1402.3,722.8 1434.7,704.1 1402.9,685.9 						"/>
            </defs>
            <clipPath id="SVGID_27_">
              <use xlink:href="#SVGID_26_"  style="overflow:visible;"/>
            </clipPath>
            <g class="st33">
              <path class="st14" d="M1402.3,722.8l-31.7-18.2l32.4-18.7l31.7,18.2L1402.3,722.8z M1372.6,704.5l29.7,17.1l30.3-17.5
                L1403,687L1372.6,704.5z"/>
            </g>
          </g>
        </g>
        <path class="st15" d="M1409.9,707.6c1,0.5,2.1,0.5,3.1,0c0.5-0.2,0.8-0.7,0.6-1.2c-0.1-0.3-0.3-0.5-0.6-0.6c-1-0.5-2.1-0.5-3.1,0
          c-0.5,0.2-0.8,0.7-0.6,1.2C1409.4,707.3,1409.6,707.5,1409.9,707.6z"/>
        <path class="st15" d="M1406.7,716.5l3.1-2.1l-0.6-1.5l-2.6-1.5l3.2-2.8c0.3-0.2,0.2-0.5-0.2-0.7c-0.4-0.2-0.8-0.1-1.2,0.1l-1,0.8
          l0,0c-2.1-0.3-4.2-0.1-6.2,0.6c-1.6,0.6-2.6,1.6-2.8,2.6c-0.2,1.2,0.7,2.6,2.5,3.6c0.1,0.1,0.3,0.2,0.4,0.2
          c0.4,0.2,0.8,0.2,1.2,0c0.3-0.2,0.3-0.5-0.1-0.7c-1.6-0.8-2.6-2-2.4-3c0.1-0.7,0.9-1.4,2-1.9c1.3-0.5,2.8-0.7,4.2-0.5l-2,1.7
          l3.2,1.9l0.3,0.7l-2.5,1.7c-0.3,0.2-0.3,0.5,0,0.7l0,0C1405.9,716.8,1406.3,716.8,1406.7,716.5z"/>
        <path class="st15" d="M1391.1,710.2c-0.3-0.2-0.3-0.5,0-0.7l5.8-3.4l1.5,0.9l1.5,0l6.4-4.9l-1.9-1.1l-7.7,2.8
          c-0.4,0.1-0.8,0.1-1.2-0.1c-0.3-0.2-0.1-0.5,0.3-0.7l8.1-3c0.5-0.2,1-0.1,1.4,0.1l3.3,1.9l-7.9,6l-3-0.1l-0.8-0.4l-4.5,2.7
          C1391.9,710.4,1391.5,710.4,1391.1,710.2L1391.1,710.2z"/>
        <path class="st15" d="M1410.8,700.3c-1.1,0.6-2.4,0.6-3.5,0c-0.6-0.2-0.9-0.8-0.7-1.3c0.1-0.3,0.4-0.6,0.7-0.7
          c1.1-0.6,2.4-0.6,3.5,0c0.6,0.2,0.9,0.8,0.7,1.3C1411.3,700,1411.1,700.2,1410.8,700.3"/>
        <path class="st15" d="M1382.8,704.9L1382.8,704.9c-0.2-0.1-0.3-0.3-0.2-0.5c0-0.1,0.1-0.2,0.2-0.2l4.7-2.6l-0.5-1.8l8.7-5
          l4.3,2.5c0.4,0.2,0.4,0.6,0.1,0.8l0,0l-6.8,4c-0.4,0.2-0.8,0.2-1.2,0l0,0c-0.2-0.1-0.3-0.3-0.2-0.5c0-0.1,0.1-0.2,0.2-0.2
          l6.4-3.7l-2.6-1.5l-6.9,4l0.5,1.8l-5.3,3C1383.6,705.1,1383.2,705.1,1382.8,704.9z"/>
        <path class="st15" d="M1402.3,695.7c-1.1,0.6-2.4,0.6-3.5,0c-0.6-0.2-0.9-0.8-0.7-1.3c0.1-0.3,0.4-0.6,0.7-0.7
          c1.1-0.6,2.4-0.6,3.5,0c0.6,0.2,0.9,0.8,0.7,1.3C1402.9,695.3,1402.6,695.6,1402.3,695.7"/>
      </g>
      <g transform="translate(0 35)">
        <g>
          <g>
            <defs>
              <polygon id="SVGID_28_" points="1330.5,682 1362.4,700 1394.5,681.1 1362.5,663 						"/>
            </defs>
            <clipPath id="SVGID_29_">
              <use xlink:href="#SVGID_28_"  style="overflow:visible;"/>
            </clipPath>
            <g class="st34">
              <path class="st14" d="M1362.4,700l-32-18l32-18.9l32,18L1362.4,700z M1332.5,681.9l29.9,16.9l30-17.7l-29.9-16.9L1332.5,681.9
                z"/>
            </g>
          </g>
        </g>
        <path class="st17" d="M1352.6,677.6l0.1,3.4l0,0l5.9-0.1l1.4-0.8l-4.9,0l6.8-4l-1-0.6l-6.8,4l-0.1-2.8L1352.6,677.6z"/>
        <path class="st17" d="M1371.3,684.4l-0.1-3.4l0,0l-5.9,0.1l-1.4,0.8l4.9,0l-6.8,4l1,0.6l6.8-4l0.1,2.8L1371.3,684.4z"/>
        <g>
          <g>
            <defs>
              <polygon id="SVGID_30_" points="1341.9,681.4 1362.6,693 1382.6,681 1361.9,669.5 						"/>
            </defs>
            <clipPath id="SVGID_31_">
              <use xlink:href="#SVGID_30_"  style="overflow:visible;"/>
            </clipPath>
            <g class="st35">
              <path class="st15" d="M1359.8,691.4l-15.1-8.5c-1.5-0.9-1.6-2.3-0.1-3.2l14.6-8.7c1.7-0.9,3.7-0.9,5.5-0.1l15.1,8.5
                c1.5,0.8,1.6,2.3,0.1,3.1l-14.7,8.8C1363.6,692.3,1361.6,692.3,1359.8,691.4z M1363.6,671.7c-1-0.5-2.2-0.5-3.2,0l-14.6,8.7
                c-0.9,0.5-0.8,1.3,0.1,1.8l15.1,8.5c1,0.5,2.2,0.5,3.2,0l14.7-8.8c0.9-0.5,0.8-1.3-0.1-1.8L1363.6,671.7z"/>
            </g>
          </g>
        </g>
        <g>
          <g>
            <defs>
              <polygon id="SVGID_32_" points="1351.7,686.4 1352.8,687 1372.1,675.5 1371,674.9 						"/>
            </defs>
            <clipPath id="SVGID_33_">
              <use xlink:href="#SVGID_32_"  style="overflow:visible;"/>
            </clipPath>
            <g class="st36">
              <path class="st15" d="M1352.8,687l-1.1-0.6l19.3-11.5l1.1,0.6L1352.8,687z"/>
            </g>
          </g>
        </g>
      </g>
    </g>
    <path class="st20" d="M993.6,710.3L941.7,680l-16.8,9.7l51.7,29.9L993.6,710.3z"/>
    <path class="st10" d="M925.4,655.8l51.1,29.2l0,34.6l-51.7-29.9L925.4,655.8z"/>
    <path class="st10" d="M993.7,676.2l-17.1,8.8l0,34.6l17.1-9.3L993.7,676.2z"/>
    <g>
      <path class="st1" d="M976.5,684.9l-51.1-29.2l16.9-8.8l51.4,29.2L976.5,684.9z"/>
      <g>
        <polygon class="st1" points="925.9,655.8 942.3,647.2 993.1,676.2 976.5,684.7 			"/>
        <path class="st10" d="M942.3,647.5l50.4,28.6l-16.1,8.2l-50.1-28.6L942.3,647.5 M942.3,647l-16.9,8.8l51.1,29.2l17.1-8.8
          L942.3,647L942.3,647z"/>
      </g>
    </g>
    <g class="suite {{ $directory_index['200']['category'] ?? '' }}" id="suite-200" data-vendor="{{ $directory_index['200']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['200']['name'] ?? '' }}">
      <polygon class="roof" points="893.5,672.9 925.4,656 976,684.9 944.9,702.5"/>
      <path class="wall" d="M925.4,656.3l50.1,28.6l-30.6,17.3L894,672.9L925.4,656.3 M925.4,655.8L893,672.8l51.9,30l31.7-17.9 L925.4,655.8L925.4,655.8z"/>
      <path class="wall" d="M893,672.8l51.9,30l-0.1,34.5L892.9,708L893,672.8z"/>
      <path class="wall" d="M976.5,684.9l-31.7,17.9l-0.1,34.5l31.7-17.8L976.5,684.9z"/>
    </g>
    <g class="suite {{ $directory_index['240']['category'] ?? '' }}" id="suite-240" data-vendor="{{ $directory_index['240']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['240']['name'] ?? '' }}">
      <path class="wall" d="M1040.1,907.6l48.7,28.9V971l-48.7-28.6V907.6z"/>
      <path class="wall" d="M1195,874.2l-106.2,62.4V971l106.2-61.6V874.2z"/>
      <polygon class="roof" points="1040.6,907.6 1146,846.3 1194.5,874.2 1088.8,936.3"/>
      <path class="wall" d="M1146,846.6l48,27.6L1088.8,936l-47.7-28.4L1146,846.6 M1146,846l-105.9,61.6l48.7,28.9l106.2-62.4L1146,846 L1146,846z"/>
    </g>
    <g class="suite {{ $directory_index['230']['category'] ?? '' }}" id="suite-230" data-vendor="{{ $directory_index['230']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['230']['name'] ?? '' }}">
      <path class="wall" d="M1267.6,779.7l105.7,62l-0.1,33.1L1267.5,814L1267.6,779.7z"/>
      <path class="wall" d="M1405.5,822.7l-32.1,19l-0.1,33.1l32.2-18.6L1405.5,822.7z"/>
      <polygon class="roof" points="1268.1,779.7 1299.7,761.8 1405,822.7 1373.4,841.5"/>
      <path class="wall" d="M1299.7,762.1l104.8,60.6l-31.1,18.4l-104.7-61.4L1299.7,762.1 M1299.7,761.5l-32.1,18.2l105.7,62l32.1-19 L1299.7,761.5L1299.7,761.5z"/>
    </g>
    <g class="suite {{ $directory_index['225']['category'] ?? '' }}" id="suite-225" data-vendor="{{ $directory_index['225']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['225']['name'] ?? '' }}">
      <path class="wall" d="M1381.5,639.8l-48.9,28.9v34.4l48.5-28.6L1381.5,639.8z"/>
      <path class="wall" d="M1226.2,606.3l106.4,62.4v34.4l-106-61.6L1226.2,606.3z"/>
      <polygon class="roof" points="1226.7,606.3 1275.4,578.5 1381,639.8 1332.6,668.5"/>
      <path class="wall" d="M1275.4,578.8l105.2,61l-47.9,28.4l-105.4-61.8L1275.4,578.8 M1275.4,578.2l-49.1,28.1l106.4,62.4l48.9-28.9 L1275.4,578.2L1275.4,578.2z"/>
    </g>
  </g>
  <g>
    <g>
      <line class="st37" x1="862.1" y1="296.8" x2="862.1" y2="300.8"/>
      <line class="st38" x1="862.1" y1="308.7" x2="862.1" y2="619.3"/>
      <line class="st37" x1="862.1" y1="623.3" x2="862.1" y2="627.3"/>
    </g>
  </g>
  <polyline class="st39" points="593,49.7 658.6,58.4 736.5,142.8 "/>
  <g>
    <g>
      <line class="st37" x1="221.4" y1="242.8" x2="221.4" y2="246.8"/>
      <line class="st40" x1="221.4" y1="254.9" x2="221.4" y2="557.2"/>
      <line class="st37" x1="221.4" y1="561.3" x2="221.4" y2="565.3"/>
    </g>
  </g>
  <g>
    <g>
      <g>
        <path class="st15" d="M662.6,379.4l-33.8-20.3v-34.6l33.8,20.3V379.4z M629.9,358.7l31.6,19v-32.5l-31.6-19V358.7z"/>
      </g>
    </g>
  </g>
  <path class="st15" d="M650.8,345.6v5.9l-5.9-3.5v5.8l-5.8-3.5v5.9L634,353v1.4l6.4,3.9l0.1,0v-5.9l5.6,3.4l0.2,0.1v-5.8l5.8,3.5
    l0.1,0v-5.9l5.1,3.1v-1.4L650.8,345.6z"/>
  <g transform="translate(-1)">
    <g>
      <g>
        <g>
          <path class="st15" d="M417.4,178.7l-30.7-18.5v-31.5l30.7,18.5V178.7z M387.7,159.8l28.7,17.3v-29.5l-28.7-17.3V159.8z"/>
        </g>
      </g>
    </g>
    <path class="st15" d="M406.6,147.9v5.3l-5.3-3.2v5.2l-5.2-3.2v5.3l-4.7-2.8v1.3l5.9,3.5l0.1,0v-5.3l5.1,3.1l0.2,0.1v-5.2l5.3,3.2
      l0.1,0v-5.3l4.7,2.8v-1.3L406.6,147.9z"/>
  </g>
  <text transform="matrix(0.75 -0.433 0.75 0.433 919.494 510.8098)"><tspan x="0" y="0" class="st41 st42 st43">To NC-54 / </tspan><tspan x="0" y="33.5" class="st41 st42 st43">Bus Stop</tspan></text>
  <text transform="matrix(0.75 -0.433 0.75 0.433 855.5355 873.2516)"><tspan x="0" y="0" class="st41 st42 st43">To Parking </tspan><tspan x="0" y="42.7" class="st41 st42 st43">Lot</tspan></text>
  <text transform="matrix(0.75 -0.433 0.75 0.433 61.5591 909.0618)"><tspan x="0" y="0" class="st41 st42 st43">To Frontier RTP  </tspan><tspan x="0" y="42.7" class="st41 st42 st43">Entrance</tspan></text>
  <g class="st44">
    <linearGradient id="SVGID_34_" gradientUnits="userSpaceOnUse" x1="554.5652" y1="81.6754" x2="567.6432" y2="105.3639">
      <stop  offset="0" style="stop-color:#FFFFFF"/>
      <stop  offset="1" style="stop-color:#B3B6B7"/>
    </linearGradient>
    <polygon class="st45" points="461.5,122.7 591.6,51.7 657.9,59.1 528.6,130.9 	"/>
    <path class="st1" d="M591.7,52.2l64.6,7.3l-127.7,70.9l-65.4-7.9L591.7,52.2 M591.5,51.2l-131.6,71.9l68.8,8.3l130.8-72.6
      L591.5,51.2L591.5,51.2z"/>
  </g>
  <g class="st44">
    <linearGradient id="SVGID_35_" gradientUnits="userSpaceOnUse" x1="611.0488" y1="95.4174" x2="626.3552" y2="125.3012">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <polygon class="st46" points="734.7,140 659.5,58.8 528.7,131.4 604,212.9 	"/>
    <linearGradient id="SVGID_36_" gradientUnits="userSpaceOnUse" x1="528.7084" y1="135.8421" x2="734.6639" y2="135.8421">
      <stop  offset="0" style="stop-color:#FFFFFF"/>
      <stop  offset="5.014054e-02" style="stop-color:#D3D5D6"/>
      <stop  offset="1" style="stop-color:#B3B6B7"/>
    </linearGradient>
    <path class="st47" d="M659.3,60.1l73.8,79.7l-128.9,71.8l-73.9-79.9L659.3,60.1 M659.5,58.8l-130.8,72.6l75.3,81.5L734.7,140
      L659.5,58.8L659.5,58.8z"/>
  </g>
  <polygon class="st39" points="590,125.9 590,55 466.8,124.6 466.8,195.4 462.4,197.7 462.4,122.1 593.1,49.2 593.1,124.1 "/>
  <polygon class="st39" points="731.6,216.7 731.6,145.8 608.4,215.4 608.4,286.2 604,288.5 604,212.9 734.7,140 734.7,214.9 "/>
  <g>
    <linearGradient id="SVGID_37_" gradientUnits="userSpaceOnUse" x1="528.3412" y1="172.1268" x2="604.3563" y2="172.1268">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st48" x1="528.7" y1="131.4" x2="604" y2="212.9"/>
    <linearGradient id="SVGID_38_" gradientUnits="userSpaceOnUse" x1="534.5681" y1="168.6648" x2="610.5789" y2="168.6648">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st49" x1="534.9" y1="127.9" x2="610.2" y2="209.4"/>
    <linearGradient id="SVGID_39_" gradientUnits="userSpaceOnUse" x1="540.795" y1="165.2028" x2="616.8015" y2="165.2028">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st50" x1="541.2" y1="124.5" x2="616.4" y2="205.9"/>
    <linearGradient id="SVGID_40_" gradientUnits="userSpaceOnUse" x1="547.022" y1="161.7408" x2="623.0241" y2="161.7408">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st51" x1="547.4" y1="121" x2="622.7" y2="202.5"/>
    <linearGradient id="SVGID_41_" gradientUnits="userSpaceOnUse" x1="553.2489" y1="158.2788" x2="629.2467" y2="158.2788">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st52" x1="553.6" y1="117.6" x2="628.9" y2="199"/>
    <linearGradient id="SVGID_42_" gradientUnits="userSpaceOnUse" x1="559.4759" y1="154.8168" x2="635.4693" y2="154.8168">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st53" x1="559.8" y1="114.1" x2="635.1" y2="195.5"/>
    <linearGradient id="SVGID_43_" gradientUnits="userSpaceOnUse" x1="565.7028" y1="151.3548" x2="641.6919" y2="151.3548">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st54" x1="566.1" y1="110.7" x2="641.3" y2="192"/>
    <linearGradient id="SVGID_44_" gradientUnits="userSpaceOnUse" x1="571.9297" y1="147.8928" x2="647.9145" y2="147.8928">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st55" x1="572.3" y1="107.2" x2="647.5" y2="188.6"/>
    <linearGradient id="SVGID_45_" gradientUnits="userSpaceOnUse" x1="578.1567" y1="144.4308" x2="654.1371" y2="144.4308">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st56" x1="578.5" y1="103.8" x2="653.8" y2="185.1"/>
    <linearGradient id="SVGID_46_" gradientUnits="userSpaceOnUse" x1="584.3836" y1="140.9688" x2="660.3597" y2="140.9688">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st57" x1="584.8" y1="100.3" x2="660" y2="181.6"/>
    <linearGradient id="SVGID_47_" gradientUnits="userSpaceOnUse" x1="590.6106" y1="137.5068" x2="666.5823" y2="137.5068">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st58" x1="591" y1="96.8" x2="666.2" y2="178.2"/>
    <linearGradient id="SVGID_48_" gradientUnits="userSpaceOnUse" x1="596.8375" y1="134.0448" x2="672.8049" y2="134.0448">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st59" x1="597.2" y1="93.4" x2="672.4" y2="174.7"/>
    <linearGradient id="SVGID_49_" gradientUnits="userSpaceOnUse" x1="603.0645" y1="130.5827" x2="679.0275" y2="130.5827">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st60" x1="603.4" y1="89.9" x2="678.7" y2="171.2"/>
    <linearGradient id="SVGID_50_" gradientUnits="userSpaceOnUse" x1="609.2914" y1="127.1208" x2="685.2501" y2="127.1208">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st61" x1="609.7" y1="86.5" x2="684.9" y2="167.8"/>
    <linearGradient id="SVGID_51_" gradientUnits="userSpaceOnUse" x1="615.5183" y1="123.6587" x2="691.4727" y2="123.6587">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st62" x1="615.9" y1="83" x2="691.1" y2="164.3"/>
    <linearGradient id="SVGID_52_" gradientUnits="userSpaceOnUse" x1="621.7452" y1="120.1967" x2="697.6953" y2="120.1967">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st63" x1="622.1" y1="79.6" x2="697.3" y2="160.8"/>
    <linearGradient id="SVGID_53_" gradientUnits="userSpaceOnUse" x1="627.9722" y1="116.7347" x2="703.9178" y2="116.7347">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st64" x1="628.3" y1="76.1" x2="703.6" y2="157.4"/>
    <linearGradient id="SVGID_54_" gradientUnits="userSpaceOnUse" x1="634.1992" y1="113.2727" x2="710.1404" y2="113.2727">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st65" x1="634.6" y1="72.7" x2="709.8" y2="153.9"/>
    <linearGradient id="SVGID_55_" gradientUnits="userSpaceOnUse" x1="640.4261" y1="109.8107" x2="716.363" y2="109.8107">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st66" x1="640.8" y1="69.2" x2="716" y2="150.4"/>
    <linearGradient id="SVGID_56_" gradientUnits="userSpaceOnUse" x1="646.653" y1="106.3487" x2="722.5856" y2="106.3487">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st67" x1="647" y1="65.7" x2="722.2" y2="147"/>
    <linearGradient id="SVGID_57_" gradientUnits="userSpaceOnUse" x1="652.8799" y1="102.8867" x2="728.8082" y2="102.8867">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st68" x1="653.2" y1="62.3" x2="728.4" y2="143.5"/>
    <linearGradient id="SVGID_58_" gradientUnits="userSpaceOnUse" x1="659.1069" y1="99.4247" x2="735.0308" y2="99.4247">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st69" x1="734.7" y1="140" x2="659.5" y2="58.8"/>
  </g>
  <g>
    <g>
      <defs>
        <polygon id="SVGID_59_" points="662.6,756.1 693.3,774.6 693.3,743.1 662.6,724.6 			"/>
      </defs>
      <clipPath id="SVGID_60_">
        <use xlink:href="#SVGID_59_"  style="overflow:visible;"/>
      </clipPath>
      <g class="st70">
        <path class="st15" d="M693.3,774.6l-30.7-18.5v-31.5l30.7,18.5V774.6z M663.6,755.7l28.7,17.3v-29.5l-28.7-17.3V755.7z"/>
      </g>
    </g>
  </g>
  <path class="st1" d="M692.2,772.8l-28.5-17.2v-29.3l28.5,17.2V772.8z"/>
  <path class="st15" d="M682.6,743.9v5.3l-5.3-3.2v5.2l-5.2-3.2v5.3l-4.7-2.8v1.3l5.9,3.5l0.1,0v-5.3l5.1,3.1l0.2,0.1V748l5.3,3.2
    l0.1,0v-5.3l4.7,2.8v-1.3L682.6,743.9z"/>
  <polygon class="st1" points="796.1,149.9 796.1,177.9 823.6,161.1 823.6,133.1 "/>
  <path class="st15" d="M814.5,144.2v5.3l-5.3,3.3v5.2l-5.2,3.3v5.3l-4.7,2.9v1.3l5.9-3.7l0.1,0v-5.3l5.1-3.2l0.2-0.1v-5.2l5.3-3.3
    l0.1,0v-5.3l4.7-2.9v-1.3L814.5,144.2z"/>
  <g>
    <g>
      <g>
        <defs>
          <polygon id="SVGID_61_" points="875.1,597.9 907.3,616.4 945.4,594.2 913.1,575.7 				"/>
        </defs>
        <clipPath id="SVGID_62_">
          <use xlink:href="#SVGID_61_"  style="overflow:visible;"/>
        </clipPath>
        <path class="st71" d="M907.3,616.4l-32.2-18.5l38-22.2l32.2,18.5L907.3,616.4z M877.3,597.8l30.1,17.3l35.7-20.8L913,577
          L877.3,597.8z"/>
      </g>
    </g>
    <g>
      <g>
        <polygon class="st1" points="907.4,614.9 877.5,597.7 912.9,577.1 942.8,594.3 			"/>
      </g>
      <g>

          <ellipse transform="matrix(0.8736 -0.4867 0.4867 0.8736 -171.2819 519.3368)" class="st15" cx="914" cy="589.3" rx="4.9" ry="2.6"/>

          <ellipse transform="matrix(0.9758 -0.2186 0.2186 0.9758 -107.4765 215.7635)" class="st15" cx="921.4" cy="593.6" rx="5.9" ry="2.2"/>

          <ellipse transform="matrix(0.9562 -0.2927 0.2927 0.9562 -133.4334 290.222)" class="st15" cx="903" cy="590.9" rx="3.3" ry="2.7"/>

          <ellipse transform="matrix(0.9964 -8.472422e-02 8.472422e-02 0.9964 -47.4838 80.1105)" class="st15" cx="920.1" cy="599.5" rx="4.9" ry="1.9"/>
        <path class="st15" d="M913.8,606.3c2-1.5,2.4-3.4,1-4.6l0.2,0.2c-1.3-0.9-1.7-2.2-1.1-3.6c0.3-0.7,0.8-1.3,0.8-2
          c0-0.5-0.4-1-0.8-1.3c-0.7-0.6-1.7-1.1-3-1.3c-1.3-0.2-2.8-0.2-4.3,0.2c-0.8,0.2-1.6,0.5-2.4,0.8c-2.3,0.6-4.5,0.3-6.8,0.6
          c-1.7,0.2-3.4,0.8-4.7,1.6c-0.3,0.2-0.7,0.5-0.9,0.7c-0.2,0.3-0.2,0.5-0.1,0.8c0.3,1.2,1.5,2.2,3.3,2.6c2.2,0.6,5.4,0.4,6.9,1.5
          c0.5,0.4,0.8,0.9,1.1,1.4c1.2,1.7,3.7,3,6.9,3.4c0.4,0.1,0.9,0.1,1.4,0.1C912.3,607.2,913.2,606.7,913.8,606.3z"/>
      </g>
    </g>
  </g>
  <g>
    <g>
      <g>
        <path class="st14" d="M551.3,534.5L522,551.4l-28.9-16.2l29.3-16.9L551.3,534.5z"/>
      </g>
    </g>
    <g>
      <polygon class="st1" points="549.2,534.6 522,550.3 495.1,535.2 522.3,519.5 		"/>
    </g>
    <path d="M534.3,532.5l-12.3-6.9c0,0,0,0-0.1,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0-0.1,0-0.1,0c0,0-0.1,0-0.1,0c0,0-0.1,0-0.1,0
      c0,0-0.1,0-0.1,0c0,0-0.1,0-0.1,0c0,0-0.1,0-0.1,0c0,0,0,0,0,0c0,0,0,0,0,0c0,0,0,0,0,0l-9.5,8.6c0,0,0,0,0,0c0,0,0,0,0,0.1
      c0,0,0,0,0,0.1c0,0,0,0,0,0.1s0,0,0,0.1c0,0,0,0,0,0.1c0,0,0,0,0.1,0.1c0,0,0,0,0,0l10.4,5.9c-1,0-2,0.2-2.7,0.7
      c-1.5,0.9-1.6,2.3-0.1,3.1c1.5,0.8,3.9,0.8,5.4-0.1s1.6-2.3,0.1-3.1l-9.3-5.2l8.9-8l7.2,4.1c-1,0-2,0.2-2.7,0.7
      c-1.5,0.9-1.6,2.3-0.1,3.1c1.5,0.8,3.9,0.8,5.4-0.1C535.7,534.7,535.7,533.3,534.3,532.5z"/>
  </g>
  <path class="st2" d="M894.1,529.1v-12.8l-21.6,0"/>
  <path class="st2" d="M968.1,727.2l17.3,1.2v-11.1"/>
  <path class="st2" d="M795.4,835.5l44.1-2l4.2-25.4"/>
  <g class="suite {{ $directory_index['155']['category'] ?? '' }}" id="suite-155" data-vendor="{{ $directory_index['155']['vendor_id'] ?? '' }}" tabindex="0" aria-label="{{ $directory_index['155']['name'] ?? '' }}">
    <path class="wall" d="M675.1,616.8L626.4,645v34.4l48.7-27.9V616.8z"/>
    <path class="wall stroke-highlight" d="M782.1,679.6l-48.7,28l-0.2,34.4l48.6-28.1L782.1,679.6z"/>
    <path class="wall" d="M626.4,679.4V645l106.9,62.7l-0.2,34.4L626.4,679.4z"/>
    <polygon class="roof" points="626.9,645 675.1,617.1 781.6,679.6 733.3,707.4"/>
    <path class="wall" d="M675.1,617.4l106,62.2l-47.7,27.4L627.4,645L675.1,617.4 M675.1,616.8L626.4,645l106.9,62.7l48.7-28 L675.1,616.8L675.1,616.8z"/>
  </g>
  <g class="st44">
    <linearGradient id="SVGID_63_" gradientUnits="userSpaceOnUse" x1="459.8986" y1="127.2273" x2="528.7084" y2="127.2273">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st72" x1="459.9" y1="123.1" x2="528.7" y2="131.4"/>
    <linearGradient id="SVGID_64_" gradientUnits="userSpaceOnUse" x1="466.164" y1="123.7878" x2="534.9353" y2="123.7878">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st73" x1="466.2" y1="119.6" x2="534.9" y2="127.9"/>
    <linearGradient id="SVGID_65_" gradientUnits="userSpaceOnUse" x1="472.4293" y1="120.3483" x2="541.1622" y2="120.3483">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st74" x1="472.4" y1="116.2" x2="541.2" y2="124.5"/>
    <linearGradient id="SVGID_66_" gradientUnits="userSpaceOnUse" x1="478.6947" y1="116.9087" x2="547.3892" y2="116.9087">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st75" x1="478.7" y1="112.8" x2="547.4" y2="121"/>
    <linearGradient id="SVGID_67_" gradientUnits="userSpaceOnUse" x1="484.96" y1="113.4692" x2="553.6161" y2="113.4692">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st76" x1="485" y1="109.4" x2="553.6" y2="117.6"/>
    <linearGradient id="SVGID_68_" gradientUnits="userSpaceOnUse" x1="491.2254" y1="110.0297" x2="559.843" y2="110.0297">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st77" x1="491.2" y1="105.9" x2="559.8" y2="114.1"/>
    <linearGradient id="SVGID_69_" gradientUnits="userSpaceOnUse" x1="497.4907" y1="106.5901" x2="566.0699" y2="106.5901">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st78" x1="497.5" y1="102.5" x2="566.1" y2="110.7"/>
    <linearGradient id="SVGID_70_" gradientUnits="userSpaceOnUse" x1="503.7561" y1="103.1506" x2="572.2968" y2="103.1506">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st79" x1="503.8" y1="99.1" x2="572.3" y2="107.2"/>
    <linearGradient id="SVGID_71_" gradientUnits="userSpaceOnUse" x1="510.0214" y1="99.7111" x2="578.5237" y2="99.7111">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st80" x1="510" y1="95.7" x2="578.5" y2="103.8"/>
    <linearGradient id="SVGID_72_" gradientUnits="userSpaceOnUse" x1="516.2868" y1="96.2715" x2="584.7507" y2="96.2715">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st81" x1="516.3" y1="92.2" x2="584.8" y2="100.3"/>
    <linearGradient id="SVGID_73_" gradientUnits="userSpaceOnUse" x1="522.5521" y1="92.832" x2="590.9776" y2="92.832">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st82" x1="522.6" y1="88.8" x2="591" y2="96.8"/>
    <linearGradient id="SVGID_74_" gradientUnits="userSpaceOnUse" x1="528.8175" y1="89.3925" x2="597.2045" y2="89.3925">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st83" x1="528.8" y1="85.4" x2="597.2" y2="93.4"/>
    <linearGradient id="SVGID_75_" gradientUnits="userSpaceOnUse" x1="535.0828" y1="85.953" x2="603.4315" y2="85.953">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st84" x1="535.1" y1="82" x2="603.4" y2="89.9"/>
    <linearGradient id="SVGID_76_" gradientUnits="userSpaceOnUse" x1="541.3482" y1="82.5134" x2="609.6584" y2="82.5134">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st85" x1="541.3" y1="78.6" x2="609.7" y2="86.5"/>
    <linearGradient id="SVGID_77_" gradientUnits="userSpaceOnUse" x1="547.6135" y1="79.0739" x2="615.8853" y2="79.0739">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st86" x1="547.6" y1="75.1" x2="615.9" y2="83"/>
    <linearGradient id="SVGID_78_" gradientUnits="userSpaceOnUse" x1="553.8789" y1="75.6344" x2="622.1122" y2="75.6344">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st87" x1="553.9" y1="71.7" x2="622.1" y2="79.6"/>
    <linearGradient id="SVGID_79_" gradientUnits="userSpaceOnUse" x1="560.1442" y1="72.1948" x2="628.3392" y2="72.1948">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st88" x1="560.1" y1="68.3" x2="628.3" y2="76.1"/>
    <linearGradient id="SVGID_80_" gradientUnits="userSpaceOnUse" x1="566.4096" y1="68.7553" x2="634.566" y2="68.7553">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st89" x1="566.4" y1="64.9" x2="634.6" y2="72.7"/>
    <linearGradient id="SVGID_81_" gradientUnits="userSpaceOnUse" x1="572.6749" y1="65.3158" x2="640.793" y2="65.3158">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st90" x1="572.7" y1="61.4" x2="640.8" y2="69.2"/>
    <linearGradient id="SVGID_82_" gradientUnits="userSpaceOnUse" x1="578.9403" y1="61.8762" x2="647.0199" y2="61.8762">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st91" x1="578.9" y1="58" x2="647" y2="65.7"/>
    <linearGradient id="SVGID_83_" gradientUnits="userSpaceOnUse" x1="585.2056" y1="58.4367" x2="653.2468" y2="58.4367">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st92" x1="585.2" y1="54.6" x2="653.2" y2="62.3"/>
    <linearGradient id="SVGID_84_" gradientUnits="userSpaceOnUse" x1="591.471" y1="54.9972" x2="659.4738" y2="54.9972">
      <stop  offset="0" style="stop-color:#B3B6B7"/>
      <stop  offset="1" style="stop-color:#FFFFFF"/>
    </linearGradient>
    <line class="st93" x1="659.5" y1="58.8" x2="591.5" y2="51.2"/>
  </g>
  <polyline class="st39" points="463.1,122.7 528.7,131.4 606.7,215.8 "/>
  <text transform="matrix(0.75 -0.433 0.75 0.433 411.2122 274.4597)"><tspan x="0" y="0" class="st25 st42 st94">2nd  </tspan><tspan x="0" y="53.1" class="st25 st42 st94">Floor</tspan></text>
  <text transform="matrix(0.75 -0.433 0.75 0.433 379.5235 691.3982)"><tspan x="0" y="0" class="st8 st42 st94">Ground  </tspan><tspan x="0" y="53.1" class="st8 st42 st94">Floor</tspan></text>
</svg>
