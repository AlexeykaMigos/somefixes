(function ($) {
    function reindex() {
        $('.cd-litter').each(function (litterIndex) {
            $(this).attr('data-litter-index', litterIndex);
            $(this).find('input, textarea').each(function () {
                this.name = this.name.replace(/cd\[litters\]\[\d+\]/, 'cd[litters][' + litterIndex + ']');
            });

            $(this).find('.cd-kitten').each(function (kittenIndex) {
                $(this).attr('data-kitten-index', kittenIndex);
                $(this).find('input, textarea').each(function () {
                    this.name = this.name.replace(/\[kittens\]\[\d+\]/, '[kittens][' + kittenIndex + ']');
                });
            });
        });
    }

    function bindMedia(context) {
        $(context || document).find('.cd-upload').off('click.cdUpload').on('click.cdUpload', function () {
            var button = $(this);
            var field = button.closest('.cd-media-row').find('input');
            var thumb = button.closest('.cd-media-field').find('.cd-thumb');
            var frame = wp.media({
                title: 'Choose image',
                button: { text: 'Use image' },
                multiple: false
            });

            frame.on('select', function () {
                var attachment = frame.state().get('selection').first().toJSON();
                field.val(attachment.url).trigger('input');
                thumb.attr('src', attachment.url);
            });

            frame.open();
        });
    }

    function buildKitten(litterIndex) {
        var kittenIndex = $('.cd-litter[data-litter-index="' + litterIndex + '"] .cd-kitten').length;
        return [
            '<div class="cd-kitten cd-mini-card" data-kitten-index="' + kittenIndex + '">',
            '<div class="cd-mini-head"><strong>New kitten</strong><button type="button" class="button cd-remove-block">Удалить</button></div>',
            '<div class="cd-grid three">',
            field('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][name]', 'Имя'),
            field('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][sex]', 'Пол: male/female', 'male'),
            field('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][badge]', 'Статус/бейдж', 'AVAILABLE'),
            field('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][old_price]', 'Старая цена'),
            field('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][price]', 'Цена'),
            mediaField('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][image]', 'Фото'),
            '</div>',
            textarea('cd[litters][' + litterIndex + '][kittens][' + kittenIndex + '][description]', 'Описание'),
            '</div>'
        ].join('');
    }

    function field(name, label, value) {
        return '<label class="cd-field"><span>' + label + '</span><input type="text" name="' + name + '" value="' + (value || '') + '"></label>';
    }

    function textarea(name, label) {
        return '<label class="cd-field"><span>' + label + '</span><textarea rows="4" name="' + name + '"></textarea></label>';
    }

    function mediaField(name, label) {
        return '<label class="cd-field cd-media-field"><span>' + label + '</span><div class="cd-media-row"><input type="url" name="' + name + '" value="" data-cd-preview><button type="button" class="button cd-upload">Upload</button></div><img src="" alt="" class="cd-thumb"></label>';
    }

    function buildLitter() {
        var litterIndex = $('.cd-litter').length;
        return [
            '<div class="cd-litter" data-litter-index="' + litterIndex + '">',
            '<div class="cd-litter-head"><strong>New Litter</strong><button type="button" class="button cd-add-kitten">Добавить котенка</button><button type="button" class="button cd-remove-block">Удалить помет</button></div>',
            '<div class="cd-grid three">',
            field('cd[litters][' + litterIndex + '][title]', 'Название помета', 'New Litter'),
            field('cd[litters][' + litterIndex + '][date]', 'Дата'),
            field('cd[litters][' + litterIndex + '][status]', 'Статус', '0 КОТЯТ В ПОМЕТЕ'),
            '</div><div class="cd-kittens">',
            buildKitten(litterIndex),
            '</div></div>'
        ].join('');
    }

    $(function () {
        bindMedia(document);

        $('.cd-tabs button').on('click', function () {
            var tab = $(this).data('tab');
            $('.cd-tabs button, .cd-tab').removeClass('active');
            $(this).addClass('active');
            $('#cd-tab-' + tab).addClass('active');
        });

        $(document).on('click', '.cd-add-litter', function () {
            $('.cd-litters').append(buildLitter());
            bindMedia($('.cd-litters').children().last());
            reindex();
        });

        $(document).on('click', '.cd-add-kitten', function () {
            var litter = $(this).closest('.cd-litter');
            var litterIndex = litter.attr('data-litter-index');
            litter.find('.cd-kittens').append(buildKitten(litterIndex));
            bindMedia(litter.find('.cd-kittens').children().last());
            reindex();
        });

        $(document).on('click', '.cd-remove-block', function () {
            $(this).closest('.cd-kitten, .cd-litter').remove();
            reindex();
        });

        $(document).on('input', 'input[name="cd[brand][name]"]', function () {
            $('[data-live="brand"]').text(this.value);
        });

        $(document).on('input', 'textarea[name="cd[home][quote]"]', function () {
            $('[data-live="hero"]').text(this.value);
        });

        $(document).on('input', '[data-cd-preview]', function () {
            $(this).closest('.cd-media-field').find('.cd-thumb').attr('src', this.value);
        });
    });
})(jQuery);
