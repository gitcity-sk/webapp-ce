<template>
    <div v-if="done">

        <div class="card bg-light mb-3">
            <div class="card-header" style="font-weight: 600">
                Projects <span class="badge badge-secondary">{{ projects.data.length }}</span>
            </div>
            <div  class="card-body py-1 px-1">
            
                <div v-for="project in projects.data" class="card card-shadow mb-1">
                    <div class="card-body py-2 px-2">
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                <span class="mr-2"><i class="far fa-bookmark"></i></span>
                            </div>
                            <div>
                                <a class="text-dark" style="font-weight: 600;" :href="'/projects/' + project.id">{{ project.profile.name }} / {{ project.name }}</a>
                                <div><small>{{ project.description | with_emoji }}</small></div>
                            </div>
                            <div class="ml-auto text-right">
                                <span class="mr-2"><i class="fas fa-folder"></i> {{ project.groups_count }}</span>
                                <span class="mr-2"><i class="fas fa-code-merge"></i> {{ project.mr_count }}</span>
                                <span><i class="fas fa-bug"></i> {{ project.issues_count }}</span>
                                <div><small>updated {{ project.created_at.date | moment }}</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>

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