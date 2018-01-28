<template>
    <div v-if="done">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Project name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects.data">
                    <td>
                        <div class="d-flex">
                            <div>
                                <i class="far fa-bookmark"></i> <a class="text-dark" style="font-weight: 600;" :href="'/projects/' + project.id">{{ project.profile.name }} / {{ project.name }}</a>
                                <small>{{ project.description }}</small>
                            </div>
                            <div class="ml-auto">
                                <i class="fas fa-code-merge"></i> {{ project.mr_count }} <i class="fas fa-bug"></i> {{ project.issues_count }}
                            </div>
                        </div>
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'
    export default {
        mounted () {
            console.log('Component ProfilesTable mounted.')
        },
        props: ['groupId'],
        data () {
            return {
                done: false,
                projects: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/groups/' + this.groupId + '/projects')
            .then(response => {
                this.projects = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>