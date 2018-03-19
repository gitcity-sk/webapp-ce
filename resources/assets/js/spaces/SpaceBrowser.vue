<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">
    <table class="table table-hover">
        <thead class="bg-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Created at</th>
                <th scope="col">Size</th>
            </tr>
        </thead>
            <tbody>
                <tr v-if="parentPath">
                    <td class="text-secondary"><a :href="parentPath">..</a></td>
                    <td></td>
                    <td></td>
                </tr>
                <directory-row v-for="directory in directories.data" :directory-data="directory"></directory-row>
                <tr v-if="doneFiles == false">
                    <td class="text-secondary"><i class="far fa-spinner-third fa-spin"></i> Files are loading...</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr v-for="file in currentPage">
                    <td><span class="mr-2"><i class="far fa-file"></i></span><a :href="file.url" class="text-dark">{{ file.name }}</a></td>
                    <td>{{ file.created_at.date | moment }}</td>
                    <td>{{ file.size }}</td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <div class="btn-group" role="group" aria-label="Pagination">
                <button v-if="page > 1" v-on:click="prevPage" class="btn btn-light">Previous</button>
                <button v-if="page < totalPages" v-on:click="nextPage" class="btn btn-light">Next</button>
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
                page: 1,
                perPage: 100
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true);
            this.loadDirecotries();
            this.loadFiles();
        },
        methods: {
            nextPath: function(path) {
                // for root paths return filename with slash
                if (path == "") return '';
                if (path !== "") return '/' + path;
            },

            loadDirecotries: function() {
                axios.get('/api/spaces/' + this.spaceId + '/directories' + this.nextPath(this.path))
                .then(response => {
                    this.directories = response.data
                    this.$parent.$emit('pageLoader', false)
                    this.done = true
                })
                .catch(e => {
                    this.errors.push(e)
                })
            },

            loadFiles: function() {
                axios.get('/api/spaces/' + this.spaceId + '/files' + this.nextPath(this.path))
                .then(response => {
                    this.files = response.data
                    this.$parent.$emit('pageLoader', false)
                    this.doneFiles = true
                })
                .catch(e => {
                    this.errors.push(e)
                })
            },

            nextPage: function() {
                console.log('Showing data from ' + this.start + ' to ' + this.stop)
                this.page++;
                window.scrollTo(0,0)
            },

            prevPage: function() {
                console.log('Showing data from ' + this.start + ' to ' + this.stop)
                if (this.page > 1) {
                    this.page--;
                }
                window.scrollTo(0,0)
            }
        },
        computed: {
            start: function() {
                if (this.page == 1) return 0;
                return ((this.page - 1) * this.perPage) + 1;
            },

            stop: function() {
                // if stop is larger then data length return length - 1
                if (this.page * this.perPage > this.files.data.length) return this.files.data.length - 1;
                return this.page * this.perPage
            },

            currentPage: function() {
                if (null !== this.files.data) {
                    return this.files.data.slice(this.start, this.stop)
                }

                return null;
            },

            totalPages: function()
            {
                if (null !== this.files.data) {
                    return Math.ceil(this.files.data.length / this.perPage);
                }
            },
            
        }
    }
</script>