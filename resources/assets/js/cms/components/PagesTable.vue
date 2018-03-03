<template>
<div>
<css-preloader :loading="done"></css-preloader>
    <div v-if="done">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Page title</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="page in pages.data">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                <i class="far fa-file"></i>
                            </div>
                            <div>
                                <a class="text-dark" style="font-weight: 600;" :href="'/pages/' + page.id">{{ page.title }}</a>
                                <div><small>/pages/{{ page.slug }}</small></div>
                            </div>
                            <div class="ml-auto">
                                <span v-tooltip:top="page.author.name" class="mr-2"><i class="far fa-user-circle"></i></span>
                                <div><small>updated {{ page.created_at.date | moment }}</small></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
    import axios from 'axios'
    import emojione from 'emojione'
    import cssPreloader from '../../vue/shared-components/css-preloader.vue';

    export default {
        props: ['projectId'],
        components: {
            cssPreloader
        },
        mounted () {
            console.log('Component PagesTabe mounted.')
        },
        data () {
            return {
                done: false,
                pages: {
                    data: []
                },
                errors: []
            }
        },
        created () {
            this.$parent.$emit('pageLoader', true)
            axios.get('/api/projects/' + this.projectId  + '/pages' )
            .then(response => {
                this.pages = response.data
                this.$parent.$emit('pageLoader', false)
                this.done = true
            })
            .catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>