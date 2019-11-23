/*
browser detection
*/
window.userAgentBrowser = {
    // Opera 8.0+
    isOpera: function() {
        return (!!root.opr && !!opr.addons) || !!root.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    },
    // Firefox 1.0+
    isFirefox: function() {
        return typeof InstallTrigger !== 'undefined';
    },
    // Safari 3.0+ "[object HTMLElementConstructor]"
    isSafari: function() {
        return /constructor/i.test(root.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!root['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));
    },
    // Internet Explorer 6-11
    isIE: function() {
        return /*@cc_on!@*/false || !!document.documentMode;
    },
    // Edge 20+
    isEdge: function() {
        return !isIE && !!root.StyleMedia;
    },
    // Chrome 1+
    isChrome: function() {
        return !!root.chrome && !!root.chrome.webstore;
    },
    // Blink engine detection
    isBlink: function() {
        return (isChrome || isOpera) && !!root.CSS;
    }
};
