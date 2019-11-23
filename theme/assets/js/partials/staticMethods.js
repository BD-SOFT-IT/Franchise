const staticMethods = {
    resizeSidebar: () => {
        if(window.location.pathname === '/') {
            let dWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;
            if(dWidth >= 991) {
                let sliderHeight = $('#sb-slider').height();
                let titleHeight = $('#sidebarContentTitle').height();
                $('#sidebarMainMenu').css({
                    'max-height': (sliderHeight + 20) + 'px',
                    'height': (sliderHeight + 20) + 'px'
                });
            }
        }
        else {
            $('#sidebarMainMenu').css('display', 'none');
        }
    },

    showError: () => {

    }
};

export default staticMethods;
