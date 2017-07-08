/**
 * Created by Samuel on 08/07/2017.
 */

$(document).ready(function() {

    var $container = $('div#appbundle_advert_images');

    var index = $container.find(':input').length;

    $('#add_image').click(function(e) {
        if ($container.find(':input').length < 5)
            add($container);

        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });

    if (index == 0) {
        add($container);
    } else {
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }

    function add($container) {

        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Image')
            .replace(/__name__/g,        index)
        ;

        var $prototype = $(template);

        addDeleteLink($prototype);

        $container.append($prototype);

        index++;
    }

    function addDeleteLink($prototype) {

        var $deleteLink = $('<a href="#" class="btn btn-danger delete-btn">Supprimer</a>');

        $prototype.append($deleteLink);

        $deleteLink.click(function(e) {
            if (index != 1) {
                $prototype.remove();
                index--;
            }

            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
    }
});