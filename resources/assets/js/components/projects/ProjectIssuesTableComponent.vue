<template>
    <div v-if="done">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Issue</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="issue in issues.data">
                <td>
                    <div class="d-flex">
                        <div class="mr-2"><i class="far fa-circle"></i></div>
                        <div>
                            <a :href="'/issues/' + issue.id" style="font-weight: 600" class="text-dark">{{ issue.title }}</a>
                            <div><small>#{{ issue.id }} opened by {{ issue.profile.name }} {{ issue.created_at.date | moment }}</small></div>
                        </div>
                        <div class="ml-auto text-right">
                            <span v-tooltip:top="issue.project.name" class="mr-2"><i class="far fa-bookmark"></i></span>
                            <span><i class="fas fa-comments"></i> {{ issue.comments_count }}</span>
                            <div><small>{{ issue.updated_at.date | moment }}</small></div>
                        </div>
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';
    import cssPreloader from '../vue-shared/css-preloader.vue';

    export default {
        components: {
            cssPreloader
        },
        mounted () {
            console.log('Component ProjectIssuesTable mounted.')
        },
        props: ['projectId'],
        data () {
            return {
                done: false,
                issues: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId + '/issues')
            .then(response => {
                this.issues = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>