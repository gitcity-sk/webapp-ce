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
                            <div class="mr-2">
                                <i class="fas fa-folder"></i>
                            </div>
                            <div>
                                <a class="text-dark" style="font-weight: 600;" :href="'/groups/' + group.id">{{ group.name }}</a>
                                <div><small>{{ group.description }}</small></div>
                            </div>
                            <div class="ml-auto">
                                <span v-tooltip:top="group.profile.name" class="mr-2"><i class="far fa-user-circle"></i></span>
                                <span><i class="far fa-bookmark"></i> {{ group.projects_count }}</span>
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