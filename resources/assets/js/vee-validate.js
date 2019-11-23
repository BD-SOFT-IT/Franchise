import VeeValidate from 'vee-validate';

const mobileValidator = {
    getMessage(field, args) {
        return 'The "' + field + '" must be in valid "Bangladeshi" format.'
    },
    validate(value, args) {
        // Returns a Boolean or a Promise that resolves to a boolean.
        let mobile_preg = /^(\+88)\d{11}$|^(880)\d{10}$|^(01)\d{9}$/;
        return mobile_preg.test(value);
    }
};

VeeValidate.Validator.extend('mobile', mobileValidator);

export default VeeValidate;
