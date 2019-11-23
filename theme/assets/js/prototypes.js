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
