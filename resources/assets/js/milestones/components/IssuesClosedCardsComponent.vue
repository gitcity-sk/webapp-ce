<template>
<div>
    <css-preloader :loading="done"></css-preloader>
    <div v-if="done">

        <div class="card bg-light mb-3">
            <div class="card-header" style="font-weight: 600">
                Open Issues <span class="badge badge-secondary">{{ issues.data.length }}</span>
            </div>
            <div  class="card-body py-1 px-1">
            
                <div v-for="issue in issues.data" class="card card-shadow mb-1">
                    <div class="card-body py-2 px-2">
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                <span class="mr-2"><i class="far fa-circle"></i></span>
                            </div>
                            <div>
                                <a :href="'/issues/' + issue.id" style="font-weight: 600" class="text-dark">{{ issue.title }}</a>
                                <div><small>#{{ issue.id }} opened by {{ issue.profile.name }} {{ issue.created_at.date | moment }}</small></div>
                                <span v-for="label in issue.labels" :class="'badge ' + label.color + ' mr-1'">{{ label.text }}</span>
                            </div>
                            <div class="ml-auto text-right">
                                <span v-tooltip:top="issue.project.name" class="mr-2"><i class="far fa-bookmark"></i></span>
                                <span><i class="fas fa-comments"></i> {{ issue.comments_count }}</span>
                                <div><small>{{ issue.updated_at.date | moment }}</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        </div>
    
    </div>
</div>
</template>

<script>
    import axios from 'axios';
    import emojione from 'emojione';
    import cssPreloader from '../../vue/shared-components/css-preloader.vue';

    export default {
        components: {
            cssPreloader
        },
        mounted () {
            console.log('Component Open card components mounted.')
        },
        props: ['milestoneId'],
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
            axios.get('/api/milestones/' + this.milestoneId + '/issues/closed')
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