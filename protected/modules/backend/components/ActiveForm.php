<?php
/**
 * Created by Idol IT.
 * Date: 10/2/12
 * Time: 3:09 PM
 */

Yii::import('bootstrap.widgets.TbActiveForm');


class ActiveForm extends TbActiveForm
{

    const INPUT_HORIZONTAL = 'backend.components.InputHorizontal';

    /**
     * Tinymce field render and connect the script
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function tinyMceRow($model, $attribute, $htmlOptions = array(), $button_position = 'top',$details=null)
    {
        if(isset($htmlOptions['name']))
            $active_id = CHtml::getIdByName($htmlOptions['name']);
        else
            $active_id = CHtml::activeId($model, $attribute);

        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/tinymce/js/tinymce/tinymce.min.js",
            CClientScript::POS_END);

        $directory_path = urlencode(Yii::getPathOfAlias('webroot')).'/images'; //full path to directory of files
        $directory_url = urlencode(Yii::app()->createAbsoluteUrl("images"));

        Yii::app()->clientScript->registerScript('tinymce_initialize_details', 'tinymce.init({
                toolbar: "link | image",
                file_browser_callback: elFinderBrowser,
                mode : "specific_textareas",
                editor_selector : "mceEditor",
                plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
                ],

                toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
                toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

                relative_urls : false,
                remove_script_host : false,
                convert_urls : true,

                width:"100%",
                height:"400px",
                language : "en",
                pagebreak_separator : "<!-- columnbreak -->",
                template_templates:[
                    {
                        title:"Product Details",
                        src: "'.$this->controller->module->assetsUrl.'/js/tinymce/js/tinymce/plugins/template/product_details.htm",
                        description:"Product Details"
                    }
                ],

                forced_root_block : "",
                extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]",

            });

            function RoxyFileBrowser(field_name, url, type, win) {
                  var roxyFileman = "'.$this->controller->module->assetsUrl.'/js/fileman/index.html";
                  if (roxyFileman.indexOf("?") < 0) {
                    roxyFileman += "?type=" + type;
                  }
                  else {
                    roxyFileman += "&type=" + type;
                  }
                  roxyFileman += "&input=" + field_name + "&value=" + document.getElementById(field_name).value;
                  if(tinyMCE.activeEditor.settings.language){
                    roxyFileman += "&langCode=" + tinyMCE.activeEditor.settings.language;
                  }
                  tinyMCE.activeEditor.windowManager.open({
                     file: roxyFileman,
                     title: "File/Image manager",
                     width: 1000,
                     height: 500,
                     resizable: "yes",
                     plugins: "media",
                     inline: "yes",
                     close_previous: "no"
                  }, {     window: win,     input: field_name    });
                  return false;
                }


                function elFinderBrowser (field_name, url, type, win) {

                  tinymce.activeEditor.windowManager.open({
                    file: "'.$this->controller->module->assetsUrl.'/js/elfinder-2.0/elfinder.php?directory_path='.$directory_path.'&directory_url='.$directory_url.'",// use an absolute path!
                    title: "elFinder 2.0",
                    width: 900,
                    height: 450,
                    resizable: "yes"
                  }, {
                    setUrl: function (url) {
                      win.document.getElementById(field_name).value = url;
                    }
                  });
                  return false;
                }
            ');

        return $this->render("tmc", array('model' => $model, 'attribute' => $attribute, 'htmlOptions' => $htmlOptions, 'active_id' => $active_id, 'button_position' => $button_position), true);
    }

    public function tinyMceRowMaxsize($model, $attribute, $htmlOptions = array(), $button_position = 'top',$details=null)
    {

        $active_id = CHtml::activeId($model, $attribute);
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/tinymce/js/tinymce/tinymce.min.js",
            CClientScript::POS_END);

        Yii::app()->clientScript->registerScript('tinymce_initialize_detailsM', '

        var max_chars    = 200; //max characters
        var max_for_html = 500; //max characters for html tags
        var allowed_keys = [8, 13, 16, 17, 18, 20, 33, 34, 35,36, 37, 38, 39, 40, 46];
        var chars_without_html = 0;

        function alarmChars(){
            if(chars_without_html > (max_chars - 25)){
                $("#chars_left").css("color","red");
            }else{
                $("#chars_left").css("color","gray");
            }
        }

        tinymce.init({
                toolbar: "link | image",
                file_browser_callback: RoxyFileBrowser,
                mode : "specific_textareas",
                editor_selector : "mceEditorMax",
                plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
                ],

                toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
                toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
                toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

                width:"100%",
                height:"400px",
                language : "en",
                pagebreak_separator : "<!-- columnbreak -->",
                template_templates:[
                    {
                        title:"Product Details",
                        src: "'.$this->controller->module->assetsUrl.'/js/tiny_mce/plugins/template/product_details.htm",
                        description:"Product Details"
                    }
                ],
                setup : function(ed) {
                    ed.on("KeyDown", function(ed,evt) {
                        whtml = tinyMCE.activeEditor.getContent();

                        without_html = whtml.replace(/(<([^>]+)>)/ig,"");
                        without_html = without_html.replace(/&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);/ig,"$1");
                        without_html = without_html.replace(/&hellip;/ig,"...");
                        without_html = without_html.replace(/&rsquo;/ig,"\'");
                        without_html = $.trim(without_html.replace(/&([A-za-z]{2})(?:lig);/ig,"$1"));

                        chars_without_html = without_html.length;
                        chars_with_html    = whtml.length;

                        wordscount = without_html.split(/[ ]+/).length;  // Just to get the wordcount, in case...

                        var key = ed.keyCode;

                        $("#chars_left").html(max_chars - chars_without_html);

                        if(allowed_keys.indexOf(key) != -1){
                            alarmChars();
                            return;
                        }

                        if (chars_with_html > (max_chars + max_for_html)){
                            ed.stopPropagation();
                            ed.preventDefault();
                        }else if (chars_without_html > max_chars-1 && key != 8 && key != 46){
                            alert("Characters limit!");
                            ed.stopPropagation();
                            ed.preventDefault();
                        }
                        alarmChars();
                    }
);
                },
                extended_valid_elements : "iframe[src|title|width|height|allowfullscreen|frameborder]",

            });

            function RoxyFileBrowser(field_name, url, type, win) {
                  var roxyFileman = "'.$this->controller->module->assetsUrl.'/js/fileman/index.html";
                  if (roxyFileman.indexOf("?") < 0) {
                    roxyFileman += "?type=" + type;
                  }
                  else {
                    roxyFileman += "&type=" + type;
                  }
                  roxyFileman += "&input=" + field_name + "&value=" + document.getElementById(field_name).value;
                  if(tinyMCE.activeEditor.settings.language){
                    roxyFileman += "&langCode=" + tinyMCE.activeEditor.settings.language;
                  }
                  tinyMCE.activeEditor.windowManager.open({
                     file: roxyFileman,
                     title: "File/Image manager",
                     width: 1000,
                     height: 500,
                     resizable: "yes",
                     plugins: "media",
                     inline: "yes",
                     close_previous: "no"
                  }, {     window: win,     input: field_name    });
                  return false;
                }
        ');

        return $this->render("tmcMax", array('model'=>$model,'attribute'=>$attribute,'htmlOptions'=>$htmlOptions,'active_id'=>$active_id,'button_position'=>$button_position), true);
    }

    /**
     * File field with attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function fileField($model, $attribute, $htmlOptions = array())
    {
        $size = null;
        if(isset($htmlOptions['previewSize']))
            $size = $htmlOptions['previewSize'];
        unset($htmlOptions['previewSize']);

        return $this->render("file_field",array("model"=>$model,"attribute"=>$attribute,'size'=>$size));
    }

    /**
     * File field with attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function tagsFieldRow($model, $attribute, $htmlOptions = array())
    {
        return $this->render("tags",array("model"=>$model,"attribute"=>$attribute,'htmlOptions'=>$htmlOptions));
    }

    /**
     * Mask Field patterns a,9,*
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @param string $mask
     * @return string
     */
    public function maskField($model, $attribute, $htmlOptions = array(), $mask = "AA-999-A999")
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/forms/jquery.inputmask.min.js",
            CClientScript::POS_END);

        $append = '<script>
        $().ready(function(){
            $("#' . CHtml::activeId($model, $attribute) . '").inputmask("' . $mask . '");
        });
        </script>';
        return $this->inputRow(TbInput::TYPE_TEXT, $model, $attribute, null, $htmlOptions) . $append;
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function uploadifyRow($model,$attribute,$relation, $htmlOptions = array()){


        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/uploadify/swfobject.js",
            CClientScript::POS_END
        );
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/js/uploadify/jquery.uploadify.v2.1.4.min.js",
            CClientScript::POS_END
        );

        return $this->render("uploadifyRow/_uploadify", array('model' => $model, 'attribute' => $attribute,
            'htmlOptions' => $htmlOptions,'relation' => $relation));
    }

    /**
     * Dropdown with jquery plugin chosen
     * @param $model
     * @param $attribute
     * @param array $data
     * @param array $htmlOptions
     * @return string
     */

    public function dropDownListChosenRow($model, $attribute, $data = array(), $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/chosen/chosen.jquery.min.js",
            CClientScript::POS_END);

        $name = CHtml::activeId($model, $attribute);
        $output = "<script>$().ready(function(){
            $(\"#" . $name . "\").chosen();
        });
        </script>";
        return $this->inputRow(TbInput::TYPE_DROPDOWN, $model, $attribute, $data, $htmlOptions) . $output;
    }

    /**
     * @param $model
     * @param $attribute
     * @param array $htmlOptions
     * @return string
     */
    public function dateFieldRow($model, $attribute, $dateFormat, $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/datepicker/bootstrap-datepicker.js",
            CClientScript::POS_END
        );

        Yii::app()->clientScript->registerCssFile(
            $this->controller->module->assetsUrl . '/lib/datepicker/datepicker.css'
        );

        $htmlOptions = array_merge(array('readonly'=>true,'hint'=>'Click to select date'), $htmlOptions);

        return $this->render('date_field',array('model'=>$model,'attribute'=>$attribute, 'dateFormat' => $dateFormat, 'htmlOptions'=>$htmlOptions));
    }

    public function dateTimeFieldRow($model, $attribute, $dateFormat, $timeFormat)
    {
        return $this->render('date_time_field',array('model'=>$model,'attribute'=>$attribute, 'dateFormat' => $dateFormat, 'timeFormat'=>$timeFormat));
    }

    public function dateRangeFieldRow($model, $attribute, $dateFormat, $htmlOptions = array())
    {
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/daterange/moment.min.js",
            CClientScript::POS_END
        );
        Yii::app()->clientScript->registerCssFile(
            $this->controller->module->assetsUrl . '/lib/daterange/daterangepicker.css'
        );
        Yii::app()->clientScript->registerCssFile(
            $this->controller->module->assetsUrl . '/lib/daterange/correct.css'
        );
        Yii::app()->clientScript->registerScriptFile(
            $this->controller->module->assetsUrl . "/lib/daterange/daterangepicker.js",
            CClientScript::POS_END
        );
        return $this->render('date_range_field',array('model'=>$model,'attribute'=>$attribute, 'dateFormat' => $dateFormat, 'htmlOptions' => $htmlOptions));
    }

    /**
     * Overriding method textFieldRow for label attributes
     * @param CModel $model
     * @param string $attribute
     * @param array $htmlOptions
     * @return string
     */

    public function textFieldRow($model, $attribute, $htmlOptions = array())
    {
        return $this->inputRow(TbInput::TYPE_TEXT, $model, $attribute, null, $htmlOptions);
    }

    /**
     * @param string $type
     * @param CModel $model
     * @param string $attribute
     * @param null $data
     * @param array $htmlOptions
     * @return string
     */
    public function inputRow($type, $model, $attribute, $data = null, $htmlOptions = array())
    {
        ob_start();
        Yii::app()->controller->widget($this->getInputClassName(), array(
            'type' => $type,
            'form' => $this,
            'model' => $model,
            'attribute' => $attribute,
            'data' => $data,
            'htmlOptions' => $htmlOptions,
        ));
        return ob_get_clean();
    }

    /**
     * Returns the input widget class name suitable for the form.
     * @return string the class name
     */
    protected function getInputClassName()
    {
        if (isset($this->input))
            return $this->input;
        else {
            switch ($this->type) {
                case self::TYPE_HORIZONTAL:
                    return self::INPUT_HORIZONTAL;
                    break;

                case self::TYPE_INLINE:
                    return self::INPUT_INLINE;
                    break;

                case self::TYPE_SEARCH:
                    return self::INPUT_SEARCH;
                    break;

                case self::TYPE_VERTICAL:
                default:
                    return self::INPUT_VERTICAL;
                    break;
            }
        }
    }
}