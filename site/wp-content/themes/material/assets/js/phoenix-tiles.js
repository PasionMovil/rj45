(function( $ ) {

    $(function() {

        var tiles = $('.phoenix-livetile'),
            imgsToAdd = $('.phoenix-livetile-extended');

        for (var i = 0, counter = 0; i < imgsToAdd.length; i++, counter++) {

            var box = $(tiles[counter]),
                el = $(imgsToAdd[i]),
                firstEl = box.find('.tiles-wrapper');

            firstEl.addClass('phoenix-livetile-extended');

            box.append(imgsToAdd[i]);

            if (counter == 6) {
                counter = 0;
            }
        }

        var aniSlicer = tiles.length;
        
        tiles.each(function(index, element) {
            var $this = $(this),
                elsToAnimate = $this.find('.phoenix-livetile-extended'),
                rnd;

            switch (aniSlicer) {
                case 4 : rnd = 7000; break
                case 2 : rnd = 11000; break
                case 1 : rnd = 15000; break
                case 6 : rnd = 20000; break
                case 5 : rnd = 25000; break
                case 3 : rnd = 29000; break
                default : rnd = 7000; break
            }

            if (elsToAnimate.length > 1) {
                $this.flexslider(
                    {   
                        selector: '.phoenix-livetile-extended',
                        animation: "fade",
                        slideshowSpeed: rnd,
                        animationSpeed: 1000,
                        pauseOnHover: true,
                        controlNav: false,
                        directionNav: false,
                    }
                );
            }

            aniSlicer--;
        });

    });

})( jQuery );