/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-20
 * Time: 10:44
 */

$(document).ready(function () {

        function addElementFormDeleteLink($formElement) {
            var $removeFormA = $('<td class="td-center"><a href="#"><img src="/img/61117_153968_delete_remove.png"></a></td>');
            $formElement.append($removeFormA);

            $removeFormA.on('click', function(e) {
                // prevent the link from creating a "#" on the URL
                e.preventDefault();

                // remove the li for the tag form
                $formElement.remove();
            });
        }

        var $collectionHolder = $('table.elements');
        // add a delete link to all of the existing tag form tr elements
        // .not(':last')
        $collectionHolder.find('tr').not(':first').each(function() {
            addElementFormDeleteLink($(this));
        });




// http://stackoverflow.com/questions/4565112/javascript-how-to-find-out-if-the-user-browser-is-chrome
// please note,
// that IE11 now returns undefined again for window.chrome
// and new Opera 30 outputs true for window.chrome
// and new IE Edge outputs to true now for window.chrome
// and if not iOS Chrome check
// so use the below updated condition
        var isChromium = window.chrome,
            winNav = window.navigator,
            vendorName = winNav.vendor,
            isOpera = winNav.userAgent.indexOf("OPR") > -1,
            isIEedge = winNav.userAgent.indexOf("Edge") > -1,
            isIOSChrome = winNav.userAgent.match("CriOS");

        if (isIOSChrome) {
            // is Google Chrome on IOS
        } else if (
            isChromium !== null &&
            isChromium !== undefined &&
            vendorName === "Google Inc." &&
            isOpera == false &&
            isIEedge == false
        ) {
            // is Google Chrome
        } else {
            // not Google Chrome
            $("#invoice_dateOfIssue").datepicker({dateFormat: 'yy-mm-dd'});
            $("#invoice_dateOfSell").datepicker({dateFormat: 'yy-mm-dd'});
            $("#invoice_paymentDue").datepicker({dateFormat: 'yy-mm-dd'});
            $("#invoice_edit_dateOfIssue").datepicker({dateFormat: 'yy-mm-dd'});
            $("#invoice_edit_dateOfSell").datepicker({dateFormat: 'yy-mm-dd'});
            $("#invoice_edit_paymentDue").datepicker({dateFormat: 'yy-mm-dd'});
        }
    }
);