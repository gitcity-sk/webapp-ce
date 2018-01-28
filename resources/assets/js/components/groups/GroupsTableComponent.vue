<template>
    <div v-if="done">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Group name</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="group in groups.data">
                    <td>
                        <div class="d-flex">
                            <div>
                                <i class="fas fa-folder"></i> <a class="text-dark" style="font-weight: 600;" :href="'/groups/' + group.id">{{ group.name }}</a>
                                <small>{{ group.description }}</small>
                            </div>
                            <div class="ml-auto">
                                <span v-tooltip:top="group.profile.name"><i class="far fa-user-circle"></i></span>
                                <i class="far fa-bookmark"></i> {{ group.projects_count }}
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
            console.log('Component GroupsTable mounted.')
        },
        data () {
            return {
                done: false,
                groups: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/groups')
            .then(response => {
                this.groups = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>