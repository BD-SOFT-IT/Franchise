export default {
    getAllProducts(apiUrl, callBack) {
        setTimeout(() => {
            axios.get(apiUrl)
                .then((response)=> {
                    callBack(response.data);
                })
                .catch((error)=> { });
        }, 500);
    },

    getCategories(apiUrl, callBack) {
        axios.get(apiUrl)
            .then((response)=> {
                callBack(response.data);
            })
            .catch((error)=> { });
    }
}