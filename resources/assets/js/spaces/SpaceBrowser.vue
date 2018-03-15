<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">
    <table class="table">
        <thead class="bg-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Size</th>
            </tr>
        </thead>
            <tbody>
                <directory-row v-for="directory in directories.data" :directory-data="directory"></directory-row>
                <tr v-if="doneFiles == false">
                    <td class="text-secondary"><i class="far fa-spinner-third fa-spin"></i> Files are loading...</td>
                    <td></td>
                </tr>
                <tr v-for="file in files.data">
                    <td><span class="mr-2"><i class="far fa-file"></i></span><a :href="file.url">{{ file.name }}</a></td>
                    <td>{{ file.size }}</td>
                </tr>
            </tbody>
        </table>
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
        props: ['spaceId', 'path'],
        data () {
            return {
                done: false,
                doneFiles: false,
                files: { data: null },
                directories: { data: null },
                errors: []
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
            }
        }
    }
</script>