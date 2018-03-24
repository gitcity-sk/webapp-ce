<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">
        <img :src="currentPage.url" class="img-fluid mb-1" alt="Responsive image">
        <small>Image browser! <span class="badge badge-danger">beta</span> {{ totalPages }} photos total.</small>
        <div class="text-center mt-3">
            <div class="btn-group" role="group" aria-label="Pagination">
                <button v-if="page > 1" v-on:click="prevPage" class="btn btn-light"><i class="far fa-chevron-left"></i></button>
                <button v-if="page < totalPages" v-on:click="nextPage" class="btn btn-light"><i class="far fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';
    import cssPreloader from '../vue/shared-components/css-preloader.vue';
    import directoryRow from './DirectoryRow.vue'

    export default {
        components: {
            cssPreloader, directoryRow
        },
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['spaceId', 'path', 'parentPath'],
        data () {
            return {
                done: false,
                doneFiles: false,
                files: { data: null },
                directories: { data: null },
                errors: [],
                page: 1, // index starting from zero
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true);
            this.loadFiles();
        },
        methods: {
            nextPath: function(path) {
                // for root paths return filename with slash
                if (path == "") return '';
                if (path !== "") return '/' + path;
            },

            loadFiles: function() {
                axios.get(this.path)
                .then(response => {
                    this.files = response.data
                    this.$parent.$emit('pageLoader', false)
                    this.done = true
                })
                .catch(e => {
                    this.errors.push(e)
                })
            },

            // Increment pages by one
            nextPage: function() {
                console.log('Showing data from ' + this.start)
                this.page++;
                window.scrollTo(0,0)
            },

            // decrement pages by one
            prevPage: function() {
                console.log('Showing data from ' + this.start)
                if (this.page > 1) {
                    this.page--;
                }
                window.scrollTo(0,0)
            }
        },
        computed: {
            start: function() {
                return this.page - 1;
            },

            // current content
            currentPage: function() {
                if (null !== this.files.data) {
                    return this.files.data[this.start]
                }

                return null;
            },

            // showing total pages
            totalPages: function()
            {
                if (null !== this.files.data) {
                    return this.files.data.length - 1; // total items -1 because zero at start
                }
            },
            
        }
    }
</script>