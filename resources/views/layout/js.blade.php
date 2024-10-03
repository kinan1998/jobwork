
        <script src="{{asset('assets/libs/tinyeditor/tinymce.min.js')}}"></script>

        <script>

                var useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
               
                tinymce.init({
                selector: '#editor, #editor2',
                plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
                mobile: {
                        plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker textpattern noneditable help formatpainter pageembed charmap mentions quickbars linkchecker emoticons advtable'
                },
                menu: {
                        tc: {
                        title: 'Comments',
                        items: 'addcomment showcomments deleteallconversations'
                        }
                },
                menubar: 'file edit view insert format tools table tc help',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_restore_when_empty: false,
                autosave_retention: '2m',
                image_advtab: true,
                importcss_append: true,
                templates: [
                        {
                        title: 'New Table',
                        description: 'creates a new table',
                        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
                        },
                        {title: 'Starting my story', description: 'A cure for writers block', content: 'Once upon a time...'},
                        {
                        title: 'New list with dates',
                        description: 'New List with dates',
                        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
                        }
                ],
                template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
                template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
                height: 600,
                image_caption: true,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
                noneditable_noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                spellchecker_ignore_list: ['Ephox', 'Moxiecode'],
                tinycomments_mode: 'embedded',
                content_style: '.mymention{ color: gray; }',
                contextmenu: 'link image imagetools table configurepermanentpen',
                a11y_advanced_options: true,
                skin: useDarkMode ? 'oxide-dark' : 'oxide',
                content_css: useDarkMode ? 'dark' : 'default',

                mentions_selector: '.mymention',
                mentions_item_type: 'profile'
                });

        </script>


        <!-- JQuery min js -->
        <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

        <!-- Bootstrap Bundle js -->
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!--Internal  Chart.bundle js -->
        <script src="{{asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>

        <!-- Ionicons js -->
        <script src="{{asset('assets/plugins/ionicons/ionicons.js')}}"></script>

        <!-- Moment js -->
        <script src="{{asset('assets/plugins/moment/moment.js')}}"></script>

        <!--Internal Sparkline js -->
        <script src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        <!-- Moment js -->
        <script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>

        <!--Internal  Flot js-->
        <script src="{{asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
        <script src="{{asset('assets/js/dashboard.sampledata.js')}}"></script>
        <script src="{{asset('assets/js/chart.flot.sampledata.js')}}"></script>

        <!-- Custom Scroll bar Js-->
        <script src="{{asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>

        <!--Internal Apexchart js-->
        <script src="{{asset('assets/js/apexcharts.js')}}"></script>

        <!-- Rating js-->
        <script src="{{asset('assets/plugins/rating/jquery.rating-stars.js')}}"></script>
        <script src="{{asset('assets/plugins/rating/jquery.barrating.js')}}"></script>

        <!-- Internal Jquery.steps js -->
	<script src="{{asset('assets/plugins/jquery-steps/jquery.steps.min.js')}}"></script>
	<script src="{{asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>

        <!--Internal  Perfect-scrollbar js -->
        <script src="{{asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('assets/plugins/perfect-scrollbar/p-scroll.js')}}"></script>

        <!-- Eva-icons js -->
        <script src="{{asset('assets/js/eva-icons.min.js')}}"></script>

        <!-- right-sidebar js -->
        <script src="{{asset('assets/plugins/sidebar/sidebar-custom.js')}}"></script>


        <!--Internal  Form-wizard js -->
        <script src="{{asset('assets/js/form-wizard.js')}}"></script>


        <!-- Sticky js -->
        <script src="{{asset('assets/js/sticky.js')}}"></script>
        <script src="{{asset('assets/js/modal-popup.js')}}"></script>

        <!-- Left-menu js-->
        <script src="{{asset('assets/plugins/side-menu/sidemenu.js')}}"></script>

        <!-- Internal Map -->
        <script src="{{asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>

        <!--Internal  index js -->
        <script src="{{asset('assets/js/index.js')}}"></script>

        <!-- Apexchart js-->
        <script src="{{asset('assets/js/apexcharts.js')}}"></script>

        <!-- custom js -->
        <script src="{{asset('assets/js/custom.js')}}"></script>
        <script src="{{asset('assets/js/jquery.vmap.sampledata.js')}}"></script>

        <!-- Internal Modal js-->
        <script src="{{asset('assets/js/modal.js')}}"></script>

        <!-- Internal Form-validation js -->
	<script src="{{asset('assets/js/form-validation.js')}}"></script>

	<!-- Internal Data tables -->
        <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>


        <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js "></script>
        <!--Internal  Select2 js -->
        <script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>

        <!--Internal  jquery-simple-datetimepicker js -->
        <script src="{{asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>

        <!-- Ionicons js -->
        <script src="{{asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>

	<!--Internal  Datatable js -->
	<script src="{{asset('assets/js/table-data.js')}}"></script>


        @if (App::getLocale() == 'ar')
                <!-- left-sidebar js -->
                <script src="{{asset('assets/plugins/sidebar/sidebar-rtl.js')}}"></script>
                <script src="../../assets/plugins/sidebar/sidebar-custom.js"></script>
        @else
                <!-- right-sidebar js -->
                <script src="{{asset('assets/plugins/sidebar/sidebar.js')}}"></script>
        @endif


        
     
