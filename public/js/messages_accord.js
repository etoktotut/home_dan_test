document.addEventListener("DOMContentLoaded", () => {
    "use strict";

    const accordion = () => {

        const messagesListElem = document.querySelector('.messages_list');
        const narrowMessageElems = document.querySelectorAll('.narrow_look');
        const wideMessageElems = document.querySelectorAll('.wide_look');

        const close = (el) => { el.classList.remove('active'); }
        const open = (el) => { el.classList.add('active'); }

        messagesListElem.addEventListener('click', (event) => {

            const target = event.target;
            const parent = target.closest('.message_item');
            const nl1 = parent.querySelector('.narrow_look');
            const wl2 = parent.querySelector('.wide_look');

            if (!target.classList.contains('message_detailed')) {

                if (nl1.classList.contains('active')) { open(wl2); close(nl1); }
                else { open(nl1); close(wl2); }
            };





        })






    }

    accordion();


})