<template>

<div>
    <css-preloader :loading="done"></css-preloader>

    <div v-if="done" class="row">
        <div class="col-12">

            <div v-if="tree.last_commit" class="card bg-light" style="margin-bottom: 15px;">
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
                            <i v-if="objectItem.type === 'tree'" class="fas fa-folder"></i>
                            <i v-else class="far fa-file"></i>
                            {{ objectItem.name }}
                        </td>
                        <td class="has-emoji" style="max-width: 320px">
                            <strong>{{ objectItem.last_commit.author.name }}</strong> {{ objectItem.last_commit.message }}
                        </td>
                        <td class="has-emoji">
                            {{ objectItem.last_commit.created_at.date | moment }}
                        </td>
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
    import cssPreloader from '../vue-shared/css-preloader.vue';

    export default {
        props: ['projectId'],
        components: {
            cssPreloader
        },
        mounted () {
            console.log('Component TreeTableComponent mounted.')
        },
        data () {
            return {
                done: false,
                tree: {
                    tree: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
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
    }
</script>