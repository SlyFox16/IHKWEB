(function ($) {
    var FileInput = function (element) {
        this.$element = $(element);
        this.listen();
    };

    FileInput.prototype = {
        constructor: FileInput,
        listen: function () {
            var self = this;
            self.$preview = self.$element.closest('.col-sm-9').find('.file-preview-frame');
            self.$element.on('change', $.proxy(self.change, self));
        },
        change: function (e) {
            var self = this;
            if (e.target.files === undefined) {
                tfiles = e.target && e.target.value ? [{name: e.target.value.replace(/^.+\\/, '')}] : [];
            } else {
                tfiles = e.target.files;
            }

            if (tfiles.length === 0) {
                return;
            }

            self.$preview.html('');
            var total = tfiles.length;

            for (var i = 0; i < total; i++) {
                (function (file) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);

                    var caption = file.name;
                    reader.onload = function (theFile) {
                        if(file.type == 'text/x-vcard') {
                            var content = '<img src="/static/images/vc-ard.png" class="file-preview-image" title="' + caption + '" alt="' + caption + '">';
                        } else {
                            var content = '<img src="' + theFile.target.result + '" class="file-preview-image" title="' + caption + '" alt="' + caption + '">';
                        }

                        self.$preview.html(content);
                    }
                })(tfiles[i]);
            }
        }
    }

    $.fn.fileinput = function (options) {
        $(this).each(function(){
            var $this = $(this), data = $this.data('fileinput');
            if (!data) {
                $this.data('fileinput', (data = new FileInput(this)))
            }
        });
    };

    var $input = $('input[type=file]');

    $(document).ready(function () {
            $input.fileinput();
    });
})(window.jQuery);