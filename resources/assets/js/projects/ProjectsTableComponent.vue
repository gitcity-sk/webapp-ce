<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">
    <table v-if="projects.data" class="table">
        <thead>
            <tr>
                <th scope="col">Project name</th>
            </tr>
        </thead>
        <tbody>
                <tr v-for="project in projects.data">
                    <td>
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
                        
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center mt-3">
            <div class="btn-group" role="group" aria-label="Pagination">
                <button v-if="projects.links.prev" v-on:click="prev" class="btn btn-light">Previous</button>
                <button v-if="projects.links.next" v-on:click="next" class="btn btn-light">Next</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';
    import cssPreloader from '../vue/shared-components/css-preloader.vue';
    
    export default {
        components: {
            cssPreloader
        },
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
        },
        methods: {
            prev: function() {
                this.done = false
                axios.get(this.projects.links.prev)
                .then(response => {
                    this.projects = response.data
                    this.$parent.$emit('pageLoader', false)
                    this.done = true
                })
                .catch(e => {
                    this.errors.push(e)
                })
            },

            next: function() {
                this.done = false
                axios.get(this.projects.links.next)
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
    }
</script>