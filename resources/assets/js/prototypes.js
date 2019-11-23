// English to Bengali Number
let finalEnglishToBengaliNumber={'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};
String.prototype.getBengaliDigitFromEnglish = function() {
    let retStr = this;
    for (let x in finalEnglishToBengaliNumber) {
        retStr = retStr.replace(new RegExp(x, 'g'), finalEnglishToBengaliNumber[x]);
    }
    return retStr;
};

String.prototype.escapeHtml = function() {
    return this.replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
};

/* Check for valid Email */
String.prototype.isValidEmail = function() {
    let email_reg = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return email_reg.test(this);
};

/* Check for valid Mobile BD */
String.prototype.isValidMobile = function() {
    let mobile_preg = /^(\+88)\d{11}$|^(880)\d{10}$|^(01)\d{9}$/;
    return mobile_preg.test(this);
};

String.prototype.orderProgressStatus = function(lang = null) {
    let status = this.toLowerCase();
    if(status === 'pending') {
        return (lang !== undefined && lang !== null && lang === 'bn') ? 'নিশ্চিতকরণের জন্য অপেক্ষারত' : 'Awaiting for confirmation';
    }
    else if(status === 'processing') {
        return (lang !== undefined && lang !== null && lang === 'bn') ? 'সরবরাহের জন্য প্রক্রিয়াধীন' : 'Processing for delivery';
    }
    else if(status === 'on delivery') {
        return (lang !== undefined && lang !== null && lang === 'bn') ? 'সরবরাহধীন' : 'Delivery on progress';
    }
    else if(status === 'delivered') {
        return (lang !== undefined && lang !== null && lang === 'bn') ? 'সরবরাহ সম্পন্ন' : 'Delivery Completed';
    }
    else if(status === 'canceled') {
        return (lang !== undefined && lang !== null && lang === 'bn') ? 'বাতিল করা হয়েছে' : 'Canceled';
    }
};

String.prototype.productUnitNameBengali = function() {
    let text = this.toLowerCase();
    if(text === 'kilogram (kg)' || text === 'kilogram' || text === 'kg') {
        return 'কেজি';
    }
    else if(text === 'gram (gm)' || text === 'gram' || text === 'gm') {
        return 'গ্রাম';
    }
    else if(text === 'piece' || text === 'pc') {
        return 'টি';
    }
    else if(text === 'liter') {
        return 'লিটার';
    }
    else if(text === 'milli liter' || text === 'ml') {
        return 'মিলি লিটার';
    }
    else if(text === 'dozen') {
        return 'ডজন';
    }
    else if(text === 'bundle') {
        return 'আঁটি';
    }
};

// only for products array
Array.prototype.sortByAsc = function(isDateTime = false, sortBy = null) {
    if(!isDateTime && sortBy === null) {
        return this.sort(function(a, b){
            if (a < b) return -1;
            else if(a > b) return  1;
            else return  0;
        });
    }
    if(!isDateTime && sortBy !== null && typeof sortBy === 'string') {
        return this.sort(function(a, b){
            if (a[sortBy] < b[sortBy]) return -1;
            else if(a[sortBy] > b[sortBy]) return  1;
            else return  0;
        });
    }
    if(isDateTime && sortBy === null) {
        return this.sort(function(a, b){
            let dt1 = new Date(a);
            let dt2 = new Date(b);
            if (dt1 < dt2) return -1;
            else if(dt1 > dt2) return  1;
            else return  0;
        });
    }
    if(isDateTime && sortBy !== null && typeof sortBy === 'string') {
        return this.sort(function(a, b){
            let dt1 = new Date(a[sortBy]);
            let dt2 = new Date(b[sortBy]);
            if (dt1 < dt2) return -1;
            else if(dt1 > dt2) return  1;
            else return  0;
        });
    }
};
Array.prototype.sortByDesc = function(isDateTime = false, sortBy = null) {
    if(!isDateTime && sortBy === null) {
        return this.sort(function(a, b){
            if (a < b) return 1;
            else if(a > b) return  -1;
            else return  0;
        });
    }
    if(!isDateTime && sortBy !== null && typeof sortBy === 'string') {
        return this.sort(function(a, b){
            if (a[sortBy] < b[sortBy]) return 1;
            else if(a[sortBy] > b[sortBy]) return  -1;
            else return  0;
        });
    }
    if(isDateTime && sortBy === null) {
        return this.sort(function(a, b){
            let dt1 = new Date(a);
            let dt2 = new Date(b);
            if (dt1 < dt2) return 1;
            else if(dt1 > dt2) return  -1;
            else return  0;
        });
    }
    if(isDateTime && sortBy !== null && typeof sortBy === 'string') {
        return this.sort(function(a, b){
            let dt1 = new Date(a[sortBy]);
            let dt2 = new Date(b[sortBy]);
            if (dt1 < dt2) return 1;
            else if(dt1 > dt2) return  -1;
            else return  0;
        });
    }
};

Storage.prototype.setObject = function(key, value) {
    if(typeof key !== 'string' && typeof value !== 'object') {
        return;
    }
    this.setItem(key, JSON.stringify(value));
};

Storage.prototype.getObject = function(key) {
    if(typeof key !== 'string') {
        return;
    }
    return this.getItem(key) && JSON.parse(this.getItem(key));
};
