<template>
    <div v-if="done">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="project in projects.data">
                    <td>
                        <a class="text-dark" style="font-weight: 600;" :href="'/projects/' + project.id">{{ project.profile.name }} / {{ project.name }}</a>
                        <small>{{ project.description }}</small>
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
            axios.get('/api/projects')
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