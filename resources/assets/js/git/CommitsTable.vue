<template>

<div>
    <css-preloader :loading="done"></css-preloader>

    <div v-if="done" class="row">
        <div class="col-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Commit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="commit in commits.data">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <span v-tooltip:top="commit.author.name" class="mr-2"><i class="far fa-user-circle"></i></span>
                                </div>

                                <div>
                                    <a class="text-dark" style="font-weight: 600;" href="#">{{ commit.message }}</a>
                                    <div><small>{{ commit.author.name }} authored {{ commit.created_at.date | moment }}</small></div>
                                </div>

                                <div class="ml-auto text-right text-monospace">
                                    {{ commit.hash_short }}
                                </div>
                            </div>
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
    import cssPreloader from '../vue/shared-components/css-preloader.vue';

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
                commits: {
                    commits: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/commits')
            .then(response => {
                this.commits = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>