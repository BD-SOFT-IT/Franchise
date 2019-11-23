/* Vee Validate Error Messages */
const dictionary = {
    en: {
        custom: {
            category_title: {
                required: () => 'Category Title can\'t be empty!',
                max: () => 'Category Title may not be more than 70 characters.',
                min: () => 'Category Title must be at least 5 characters.',
            },
            category_title_bangla: {
                max: () => 'Category Title Bangla may not be more than 70 characters.',
                min: () => 'Category Title Bangla must be at least 5 characters.',
            },
            category_description: {
                required: () => 'Category Description can\'t be empty!',
                max: () => 'Category Description may not be more than 255 characters.',
                min: () => 'Category Description must be at least 50 characters.',
            },
            category_type: {
                required: () => 'Category Type must be selected!'
            },
            category_parent_id: {
                required: () => 'Category Parent must be selected!'
            }
        }
    }
};

export default dictionary;
