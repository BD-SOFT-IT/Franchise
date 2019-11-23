<template>
    <div class="autosuggest-input">
        <vue-autosuggest v-model="searchText" :suggestions="filteredOptions" @selected="onSelected" :limit="limit" :input-props="inputProps"
                         :get-suggestion-value="getSuggestionValue" @input="onInputChange">

            <template slot="after-input">
                <button type="submit">
                    <i class="icon ion-ios-search"></i>
                </button>
            </template>

            <template slot-scope="{suggestion}">
                <div class="suggestion-item d-block">
                    <a class="media" :href="suggestion.item.url">
                        <img :src="suggestion.item.image" class="align-self-center mr-3" :alt="suggestion.item.title">
                        <div class="media-body">

                            <h5 class="suggestion-item-value" v-html="getMarkedTitle(suggestion.item)"></h5>

                        </div>
                    </a>
                </div>
            </template>
        </vue-autosuggest>
    </div>
</template>

<script>
    import { VueAutosuggest } from 'vue-autosuggest';
    export default {
        name: 'live-search',
        components: { VueAutosuggest },
        data() {
            return {
                searchText: '',
                options: [{
                    data: []
                }],
                filteredOptions: [],
                inputProps: {
                    id: "product_autosuggest_input",
                    class: 'autosuggest-input-box',
                    placeholder: 'Select for Product.....'
                },
                limit: 20
            };
        },
        methods: {
            onSelected(option) {
                window.location.href = option.item.url;
            },
            onInputChange(text) {
                this.searchText = text;
                if (text === '' || text === undefined || text === null) {
                    return;
                }
                this.fetchData(text);
                /* Full control over filtering. Maybe fetch from API */
          /*      const filteredData = this.options[0].data.filter((item) => {
                    return item.title.toLowerCase().indexOf(text.toLowerCase()) > -1;
                }).slice(0, this.limit);*/
            },
            getSuggestionValue(suggestion) {
                return suggestion.item.title;
            },
            getMarkedTitle(item) {
                //let markedTitle = '';
                let title = item.title;

                if(!this.searchText) {
                    title = item.title;
                }
                else {
                    title = title.replace(new RegExp(this.searchText, "gi"), (match) => {
                        return '<span class="matched-text">' + match + '</span>';
                    });
                }

                /*if(this.searchText.length > 0 && (titleBangla.substr(0, this.searchText.length).toUpperCase() === this.searchText.toUpperCase())) {
                    titleBangla = '<span class="matched-text">' + titleBangla.substr(0, this.searchText.length) + '</span>' + titleBangla.substr(this.searchText.length);
                }

                if(item.category_type === 'parent') {
                    markedTitle = title + ' <small class="adorsho-lipi-11">(' + titleBangla + ')</small>';
                }
                else if(item.category_type === 'child') {
                    markedTitle = '&emsp;&ensp;' + title + ' <small class="adorsho-lipi-11">(' + titleBangla + ')</small>';
                }
                else {
                    markedTitle = '&emsp;&emsp;&ensp;&ensp;&nbsp;' + title + ' <small class="adorsho-lipi-11">(' + titleBangla + ')</small>';
                }*/
                return title;
            },
            showToastMsg(msg, method = 'show', duration = 2500) {
                this.$toasted[method](msg, {
                    action : {
                        text : '',
                        icon: 'times',
                        onClick : (e, toastObject) => {
                            toastObject.goAway(0);
                        }
                    },
                    duration: duration
                });
            },
            handleServerErrors(error) {
                let self = this;
                if(error.response.data.hasOwnProperty('error')) {
                    this.showToastMsg(error.response.data.error, 'error', 5000);
                }
                else if(error.response.data.hasOwnProperty('errors')) {
                    let serverErrors = error.response.data.errors;
                    for(let err in serverErrors) {
                        if(serverErrors.hasOwnProperty(err)) {
                            self.showToastMsg(serverErrors[err], 'error', 5000);
                        }
                    }
                }
            },
            fetchData(search) {
                axios.post('/bs-client-api/search', {
                    search: search
                })
                    .then((response) => {
                        //this.options[0].data = response.data.products;
                        this.filteredOptions = [{
                            data: response.data.products
                        }];
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
            }
        },

        watch: {
            searchText(val) {
                if(val.length <= 0) {
                    this.filteredOptions = [{
                        data: this.options[0].data.slice(0, this.limit)
                    }];
                }
            }
        },

        created() {

        }
    }
</script>

<style lang="scss">
    #autosuggest { width: 100%; display: block;

        ul {
            width: 100%;
            color: rgba(30, 39, 46,1.0);
            list-style: none;
            margin: 0;
            padding: 0.5rem 0 .5rem 0;
        }
        li {
            margin: 0 0 0 0;
            border-radius: 0;
            padding: 5px 0 5px 10px;
            display: block;
            align-items: center;
        }
        li:hover {
            cursor: pointer;
        }

        .autosuggest__results-container {
            position: absolute;
            width: calc(100% - 60px);
            z-index: 999999;
            top: 52px;
        }

        .autosuggest__results {
            max-height: 500px;
            overflow-y: scroll;
            border: 2px solid var(--accent-color);
            border-top-left-radius: 30px;
            background-color: #f7f7f7;
        }

        .suggestion-item .media img {
            display: flex;
            max-height: 50px;
            border-radius: 15px;
            margin-right: 10px;
        }

        .suggestion-item-value {
            font-size: 12px !important;
            font-family: "Open Sans", sans-serif;
            font-weight: 600;
            white-space: nowrap;
            text-overflow: ellipsis;
        }

        .autosuggest__input--open {
            border-bottom-left-radius: 0;
        }

        .autosuggest__results-item--highlighted, .matched-text {
            background-color: var(--accent-color);
        }
        .autosuggest__results-item--highlighted a { color: #fff;
            .matched-text { color: var(--accent-color); background-color: #fff; }
        }
    }
</style>
