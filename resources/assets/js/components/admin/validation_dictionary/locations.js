/* Vee Validate Error Messages */
const dictionary = {
    en: {
        custom: {
            location_type: {
                required: () => 'Location type must be selected!'
            },
            location_country: {
                required: () => 'Country must be selected!'
            },
            location_state: {
                required: () => 'State must be selected!'
            },
            location_name: {
                required: () => 'Location name can\'t be empty!',
                min: () => 'Location name should not be less than 3 characters',
                max: () => 'Location name may not exceed more than 50 characters'
            }
        }
    }
};

export default dictionary;
