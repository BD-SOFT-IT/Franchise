<template>
    <div class="autosuggest-input">
        <vue-autosuggest v-model="searchText" :suggestions="filteredOptions" @selected="onSelected" :limit="50" :input-props="inputProps"
                         :get-suggestion-value="getSuggestionValue" @input="onInputChange">
            <template slot-scope="{suggestion}">
                <div class="suggestion-item">
                    <div class="suggestion-item-value" v-html="getMarkedTitle(suggestion.item)"
                         :class="{'category-sub' : suggestion.item.category_type === 'child', 'category-parent' : suggestion.item.category_type === 'parent'}">
                    </div>
                </div>
            </template>
        </vue-autosuggest>
    </div>
</template>

<script>
    import { VueAutosuggest } from 'vue-autosuggest';
    export default {
        components: { VueAutosuggest },
        data() {
            return {
                searchText: '',
                options: [{
                    data: []
                }],
                filteredOptions: [],
                inputProps: {
                    id: "category_autosuggest_input",
                    class: 'autosuggest-input-box form-control',
                    placeholder: 'Select Categories for Product'
                },
                limit: 50
            };
        },
        methods: {
            onSelected(option) {
                this.$emit('selected', option.item);
            },
            onInputChange(text) {
                this.searchText = text;
                if (text === '' || text === undefined || text === null) {
                    return;
                }
                /* Full control over filtering. Maybe fetch from API */
                const filteredData = this.options[0].data.filter((item) => {
                    return item.category_title.toLowerCase().indexOf(text.toLowerCase()) > -1 || item.category_title_bangla.indexOf(text) > -1;
                }).slice(0, this.limit);

                this.filteredOptions = [{
                    data: filteredData
                }];
            },
            getSuggestionValue(suggestion) {
                return suggestion.item.category_title;
            },
            getMarkedTitle(item) {
                let markedTitle = '';
                let title = item.category_title;
                let titleBangla = item.category_title_bangla;

                if(!this.searchText) {
                    title = item.category_title;
                }
                else {
                    title = title.replace(new RegExp(this.searchText, "gi"), (match) => {
                        return '<span class="matched-text">' + match + '</span>';
                    });
                }

                if(this.searchText.length > 0 && (titleBangla.substr(0, this.searchText.length).toUpperCase() === this.searchText.toUpperCase())) {
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
                }
                return markedTitle;
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
            let self = this;
            window.addEventListener('load', () => {
                axios.get('/bs-admin-api/categories/all')
                    .then((response) => {
                        self.options[0].data = response.data;
                        self.filteredOptions = [{
                            data: response.data.slice(0, self.limit)
                        }];
                    })
                    .catch((error) => {
                        self.handleServerErrors(error);
                    });
            });
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
            border-radius: 5px;
            padding: 5px 0 5px 10px;
            display: flex;
            align-items: center;
        }
        li:hover {
            cursor: pointer;
        }

        .suggestion-item-value {
            font-size: 12px !important;
            font-family: "Open Sans", sans-serif;
            font-weight: 600;
        }

        .autosuggest__results-item--highlighted, .matched-text {
            background-color: #ffc107;

        }
    }
</style>
