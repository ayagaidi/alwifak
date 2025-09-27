// $(document).ready(function () {
//     $('.counter').each(function () {
//         $(this).prop('Counter', 0).animate({
//             Counter: $(this).text()
//         }, {
//             duration: 4000,
//             easing: 'swing',

//             step: function (now) {
//                 $(this).text(Math.ceil(now));
//             }
//         });
//     });
// });

$(document).ready(function () {
    $('.counter').each(function () {
        var $this = $(this);
        var targetValue = parseFloat($this.text().replace(/[^\d.]/g, '')); // Extract numeric value from text
        $this.prop('Counter', 0).animate({
            Counter: targetValue
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                // Check if the target has decimals
                if (targetValue % 1 !== 0) {
                    $this.text(now.toFixed(1)); // Format to 1 decimal place
                } else {
                    $this.text(Math.ceil(now)); // Format as integer
                }
            }
        });
    });
});