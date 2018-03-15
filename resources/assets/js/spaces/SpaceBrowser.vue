<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Size</th>
            </tr>
        </thead>
            <tbody>
                <tr v-for="file in files.data">
                    <td>{{ file.name }}</td>
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

    export default {
        components: {
            cssPreloader
        },
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['spaceId', 'path'],
        data () {
            return {
                done: false,
                files: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/spaces/' + this.spaceId + '/files' + this.nextPath(this.path))
            .then(response => {
                this.files = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        },
        methods: {
            nextPath: function(path) {
                // for root paths return filename with slash
                if (path == "") return '';
                if (path !== "") return '/' + path;
            }
        }
    }
</script>