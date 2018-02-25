<template>

<div>
    <css-preloader :loading="done"></css-preloader>

    <div v-if="done" class="row">
        <div class="col-12">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tags</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="tag in tags.data">
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-2">
                                    <span class="mr-2"><i class="fas fa-tag"></i></span>
                                </div>

                                <div class="branch-commit">
                                    <a class="text-dark" style="font-weight: 600;" href="#">{{ tag.name }}</a>
                                    <div>
                                        <small>
                                            <span class="mr-2"><i class="far fa-code-commit"></i></span><a href="#">{{ tag.commit.hash_short }}</a> {{ tag.commit.message }} {{ tag.commit.created_at.date | moment }}
                                        </small>
                                    </div>
                                </div>

                                <div class="ml-auto text-right">
                                    
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
                tags: {
                    tags: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/tags')
            .then(response => {
                this.tags = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>