<template>
    <div class="autosuggest-input">
        <vue-autosuggest v-model="searchText" :suggestions="filteredOptions" @selected="onSelected" :limit="50" :input-props="inputProps"
                          :get-suggestion-value="getSuggestionValue" @input="onInputChange">
            <template slot-scope="{suggestion}">
                <div class="suggestion-item">
                    <div class="suggestion-item-value">
                        <strong>Expected Hour:</strong> <span v-html="getHighlightedText(suggestion.item.expected_hour)"></span>
                        <br>
                        <strong>Preferred Time:</strong> <span v-html="getHighlightedText(suggestion.item.expected_time)"></span>
                    </div>
                </div>
            </template>
        </vue-autosuggest>
    </div>
</template>

<script>
    import { VueAutosuggest } from 'vue-autosuggest';
    export default {
        props: ['options_data', 'options_api_url'],
        components: { VueAutosuggest },
        data() {
            return {
                searchText: '',
                options: [{
                    data: []
                }],
                filteredOptions: [],
                inputProps: {
                    id: "schedule_autosuggest_input",
                    class: 'autosuggest-input-box',
                    onInputChange: this.onInputChange,
                    placeholder: 'Add Delivery Schedules for the location'
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
                    return item.expected_time.toLowerCase().indexOf(text.toLowerCase()) > -1 || item.expected_hour.toLowerCase().indexOf(text.toLowerCase()) > -1;
                }).slice(0, this.limit);

                this.filteredOptions = [{
                    data: filteredData
                }];
            },
            getSuggestionValue(suggestion) {
                return '';
            },
            getHighlightedText(text) {
                if(!this.searchText) {
                    return text;
                }
                else {
                    return text.replace(new RegExp(this.searchText, "gi"), (match) => {
                        return '<span class="matched-text">' + match + '</span>';
                    });
                }
            },
            fetchServerSideData() {
                axios.get(this.options_api_url)
                    .then((response) => {
                        this.options[0].data = response.data;
                        this.filteredOptions = [{
                            data: response.data.slice(0, this.limit)
                        }];
                    })
                    .catch((error) => {
                        this.handleServerErrors(error);
                    });
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
            },
            options_data(val) {
                if(Array.isArray(val)) {
                    this.options[0].data = val;
                    this.filteredOptions = [{
                        data: val.slice(0, this.limit)
                    }];
                }
            }
        },

        created() {
            if((typeof this.options_api_url) === 'string') {
                this.fetchServerSideData();
            }
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
