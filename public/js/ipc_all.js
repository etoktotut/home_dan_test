document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const camPerPage = document.querySelector("#cam_pp");

    camPerPage.addEventListener("change", () => {
        // TODO - window location href нахрена нужен ?
        const windowLocationHref = document.indow.location.href;
        const b = (windowLocationHref = document.split("?"));

        if (b[1]) {
            const queries = {};
            const q1 = window.location.search.substr(1).split("&");

            q1.forEach(element => {
                const i = element.split("=");
                queries[i[0].toString()] = unescape(i[1].toString());
            });
            queries["cam_pp"] = camPerPage.value;
            const url = Object.keys(queries)
                .map(k => {
                    return (
                        encodeURIComponent(k) +
                        "=" +
                        encodeURIComponent(queries[k])
                    );
                })
                .join("&");
            window.location.href = b[0] + "?" + url;
        } else {
            window.location.href = b[0] + "?" + "cam_pp=" + camPerPage.value; // it reload page
        }
    });

    // $('#cam_pp').on('change',function() {
    //   // window.location = window.location+"&cam_pp=" + this.value;
    //       var $s=window.location.href;
    //       var $b=[];
    //       $b=$s.split("?");
    //
    //       if ($b[1]) {
    //        var queries = {};
    //          $.each(window.location.search.substr(1).split('&'), function(c,q){
    //              const i = q.split('=');
    //              queries[i[0].toString()] = unescape(i[1].toString()); // change escaped characters in actual format
    //              });
    //              queries['cam_pp']=this.value;
    //              window.location.href=$b[0]+"?"+$.param(queries); // it reload page
    //                }
    //                else {
    //                  window.location.href=$b[0]+"?"+"cam_pp="+this.value; // it reload page
    //                }
    //   });
    //

    const begunokChange = (range, range_value, range_units, range_step, range_check) => {

        range_value.innerHTML = range.value + " " + range_units;
        const px1 =
            (range.valueAsNumber - parseInt(range.min)) * range_step -
            range_value.offsetWidth / 2;
        range_value.parentElement.style.left = px1 + "px";
        range_check.checked = true;
    };

    const begunokStart = (rangeId, rangeValueId, rangeUnitsName, rangeCheckId) => {
        const myRange1 = document.querySelector(rangeId);
        const myValue1 = document.querySelector(rangeValueId);
        const myUnits1 = rangeUnitsName;
        const myChk1 = document.getElementById(rangeCheckId);
        const step1 =
            myRange1.offsetWidth /
            (parseInt(myRange1.max) - parseInt(myRange1.min));
        const px1 =
            (myRange1.valueAsNumber - parseInt(myRange1.min)) * step1 -
            myValue1.offsetWidth / 2;

        myValue1.innerHTML = myRange1.value + " " + myUnits1;
        myValue1.parentElement.style.left = px1 + "px";
        myValue1.parentElement.style.top = myRange1.offsetHeight + "px";
        myRange1.addEventListener("input", () => {
            begunokChange(myRange1, myValue1, myUnits1, step1, myChk1);
        });
    };

    begunokStart("#AnglRange", "#AnglValue", "град.", "ang_chk");
    begunokStart("#IrRange", "#IrValue", "метров", "ir_chk");

    const startStockChk = () => {
        const mainStockChkElem = document.querySelector('.main__stock__chk');
        const subStockChkElems = document.querySelectorAll('.sub__stock__chk');

        const subStocksDeactivate = () => {
            if (mainStockChkElem.checked) {
                subStockChkElems.forEach(chk => {
                    chk.checked = false;
                    chk.disabled = true;
                });

                console.log(subStockChkElems);

            }
        };
        const subStoksActivate = () => {
            subStockChkElems.forEach(chk => {
                chk.disabled = false;
            });
        };

        subStocksDeactivate();

        mainStockChkElem.addEventListener('click', () => {

            mainStockChkElem.checked ? subStocksDeactivate() : subStoksActivate();
        });
    };

    startStockChk();

    // $(document).ready(function () {
    //     if ($("#isOnstock").prop("checked") == true) {
    //         $("#isOnRstStock").prop("disabled", true);
    //         $("#isOnRstStock").prop("checked", false);
    //         $("#isOnSpbStock").prop("disabled", true);
    //         $("#isOnSpbStock").prop("checked", false);
    //         $("#isOnMskStock").prop("disabled", true);
    //         $("#isOnMskStock").prop("checked", false);
    //     }
    // });

    // $("#isOnstock").click(function () {
    //     if (this.checked) {
    //         $("#isOnRstStock").prop("disabled", true);
    //         $("#isOnRstStock").prop("checked", false);
    //         $("#isOnSpbStock").prop("disabled", true);
    //         $("#isOnSpbStock").prop("checked", false);
    //         $("#isOnMskStock").prop("disabled", true);
    //         $("#isOnMskStock").prop("checked", false);
    //     } else {
    //         $("#isOnRstStock").prop("disabled", false);
    //         $("#isOnSpbStock").prop("disabled", false);
    //         $("#isOnMskStock").prop("disabled", false);
    //     }
    // });
});
