let inputTitle = $('#title');
let inputFriendlyURL = $('#slug');
let inputFriendlyURL2 = $('#slug-2');

inputTitle.keyup(function(){
    inputFriendlyURL.val( slugify(inputTitle.val()) );
    inputFriendlyURL2.val( slugify(inputTitle.val()) );
});

function slugify(text)
{
    return text.toString().toLowerCase()
        .escapeDiacritics()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-')
        .replace(/^-+/, '')
        .replace(/-+$/, '');
}

String.prototype.escapeDiacritics = function()
{
    return this.replace(/ą/g, 'a').replace(/Ą/g, 'A')
        .replace(/ć/g, 'c').replace(/Ć/g, 'C')
        .replace(/ę/g, 'e').replace(/Ę/g, 'E')
        .replace(/ł/g, 'l').replace(/Ł/g, 'L')
        .replace(/ń/g, 'n').replace(/Ń/g, 'N')
        .replace(/ó/g, 'o').replace(/Ó/g, 'O')
        .replace(/ś/g, 's').replace(/Ś/g, 'S')
        .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
        .replace(/ź/g, 'z').replace(/Ź/g, 'Z');
};


function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#article-image').attr('src', e.target.result);
            $('#article-image').css('display', 'block');
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    readURL(this);
});


// SLIDER

function Slider( element ) {
    this.el = document.querySelector( element );
    this.init();
}

Slider.prototype = {
    init: function() {
        this.links = this.el.querySelectorAll( "#slider-nav a" );
        this.wrapper = this.el.querySelector( "#slider-wrapper" );
        this.navigate();
        $('.caption').first().addClass( "visible" );
    },
    navigate: function() {

        for( var i = 0; i < this.links.length; ++i ) {
            var link = this.links[i];
            this.slide( link );
        }
    },

    animate: function( slide ) {
        var parent = slide.parentNode;
        var caption = slide.querySelector( ".caption" );
        var captions = parent.querySelectorAll( ".caption" );
        for( var k = 0; k < captions.length; ++k ) {
            var cap = captions[k];
            if( cap !== caption ) {
                cap.classList.remove( "visible" );
            }
        }
        caption.classList.add( "visible" );
    },

    slide: function( element ) {
        var self = this;
        element.addEventListener( "click", function( e ) {
            e.preventDefault();
            var a = this;
            self.setCurrentLink( a );
            var index = parseInt( a.getAttribute( "data-slide" ), 10 ) + 1;
            var currentSlide = self.el.querySelector( ".slide:nth-child(" + index + ")" );

            self.wrapper.style.left = "-" + currentSlide.offsetLeft + "px";
            self.animate( currentSlide );

        }, false);
    },
    setCurrentLink: function( link ) {
        var parent = link.parentNode;
        var a = parent.querySelectorAll( "a" );

        link.className = "current";

        for( var j = 0; j < a.length; ++j ) {
            var cur = a[j];
            if( cur !== link ) {
                cur.className = "";
            }
        }
    }
};

document.addEventListener( "DOMContentLoaded", function() {
    var aSlider = new Slider( "#slider" );

});
