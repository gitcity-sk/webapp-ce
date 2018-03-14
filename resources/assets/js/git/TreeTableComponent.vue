<template>

<div>
    <css-preloader :loading="done"></css-preloader>

    <div v-if="done" class="row">
        <div class="col-12">

            <div v-if="tree.last_commit" class="card bg-light mb-3">
                <div class="card-body"><strong>{{ tree.last_commit.author }}</strong> {{ tree.last_commit.message }}</div>
            </div>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>File</th>
                        <th>Last Commit</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="objectItem in tree.data">
                        <td style="max-width: 320px">
                            <span class="mr-2">
                                <i v-if="objectItem.type === 'tree'" class="fas fa-folder"></i>
                                <i v-else class="far fa-file"></i>
                            </span>
                            <span v-if="objectItem.type === 'tree'"><a :href="'/projects/' + projectId + '/files' + nextPath(objectItem.path, objectItem.name)">{{ objectItem.name }}</a></span>
                            <span v-else>{{ objectItem.name }}</span>
                        </td>
                        <commit :commit-sha="objectItem.last_commit.sha" :project-id="projectId"></commit>
                    </tr>
                </tbody>
            </table>

        </div> <!-- end col -->
    </div> <!-- end row -->

</div>

</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'
    import cssPreloader from '../vue/shared-components/css-preloader.vue';
    import commit from './Commit.vue';

    export default {
        props: ['projectId', 'repoPath'],
        components: {
            cssPreloader, commit
        },
        mounted () {
            console.log('Component TreeTableComponent mounted.')
        },
        data () {
            return {
                done: false,
                tree: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            if (this.repoPath !== null) {

                axios.get('/api/projects/' + this.projectId + '/tree/' + this.repoPath)
                .then(response => {
                    this.tree = response.data
                    this.$parent.$emit('pageLoader', false)
                    this.done = true
                })
                .catch(e => {
                    this.errors.push(e)
                })

            } else {

                axios.get('/api/projects/' + this.projectId + '/tree')
                .then(response => {
                    this.tree = response.data
                    this.$parent.$emit('pageLoader', false)
                    this.done = true
                })
                .catch(e => {
                    this.errors.push(e)
                })

            }

            this.tree.data.forEach(data => {
                console.log(data);
            });   
        },
        methods: {
            nextPath: function(path, fileName) {
                // for root paths return filename with slash
                if (path == "") return '/' + fileName;

                //for all other paths return current path + filename
                if (path != "") return '/' + path + '/' + fileName;
            }
        }
    }
</script>