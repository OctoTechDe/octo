<template>
    <div class="block block-condensed">
        <div class="block-heading">
        <div class="app-heading app-heading-small">
            <div class="title">
                <h2>API</h2>
                <p>Personal Access Tokens</p>
            </div>
            <div class="heading-elements">
                <a class="btn btn-default btn-clean btn-icon-fixed" @click="showCreateTokenForm"><span class="icon-key"></span> Create Token</a>
            </div>
        </div>
        </div>
        <div class="block-content">




            <!-- No Tokens Notice -->
            <div class="alert alert-default alert-icon-block" v-if="tokens.length === 0">
                <div class="alert-icon">
                    <span class="icon-lamp"></span>
                </div>
                You have not created any personal access tokens.
            </div>

            <!-- Personal Access Tokens -->
            <table class="table table-borderless" v-if="tokens.length > 0">
                <thead>
                <th>Name</th>
                <th>Action</th>
                </thead>

                <tbody>
                <tr v-for="token in tokens">
                    <!-- Client Name -->
                    <td style="vertical-align: middle;">
                        {{ token.name }}
                    </td>

                    <!-- Delete Button -->
                    <td style="vertical-align: middle;">
                        <button class="btn btn-danger btn-icon-fixed" @click="revoke(token)"><span class="icon-delete"></span> Delete</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

<div class="block block-condensed">
        <div class="block-heading">
        <div class="app-heading app-heading-small">
            <div class="title">
                <h2>Documentation</h2>
                <p>How to make API calls</p>
            </div>
        
        </div>
        </div>
        <div class="block-content"></div>

            <div class="block-divider-text">
                                        Block divider text
                                    </div>

                                    
           
        </div>
    </div>






        <!-- Create Token Modal -->
        <div class="modal fade" id="modal-create-token" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Create Token
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Form Errors -->
                        <div class="alert alert-danger" v-if="form.errors.length > 0">
                            <p><strong>Whoops!</strong> Something went wrong!</p>
                            <br>
                            <ul>
                                <li v-for="error in form.errors">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>

                        <!-- Create Token Form -->
                        <form class="form-horizontal" role="form" @submit.prevent="store">
                            <!-- Name -->
                            <div class="form-group">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="create-token-name" type="text" class="form-control" name="name" v-model="form.name">
                                </div>
                            </div>

                            <!-- Scopes -->
                            <div class="form-group" v-if="scopes.length > 0">
                                <label class="col-md-4 control-label">Scopes</label>

                                <div class="col-md-6">
                                    <div v-for="scope in scopes">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"
                                                    @click="toggleScope(scope.id)"
                                                    :checked="scopeIsAssigned(scope.id)">

                                                    {{ scope.id }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click="store">
                            Create
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Access Token Modal -->
        <div class="modal fade" id="modal-access-token" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Personal Access Token
                        </h4>
                    </div>

                    <div class="modal-body">
                        <p>
                            Here is your new personal access token. This is the only time it will be shown so don't lose it!
                            You may now use this token to make API requests.
                        </p>

                        <pre><code>{{ accessToken }}</code></pre>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                accessToken: null,

                tokens: [],
                scopes: [],

                form: {
                    name: '',
                    scopes: [],
                    errors: []
                }
            };
        },

        /**
         * Prepare the component.
         */
        ready() {
            this.getTokens();
            this.getScopes();

            $('#modal-create-token').on('shown.bs.modal', () => {
                $('#create-token-name').focus();
            });
        },

        methods: {
            /**
             * Get all of the personal access tokens for the user.
             */
            getTokens() {
                this.$http.get('/oauth/personal-access-tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
            },

            /**
             * Get all of the available scopes.
             */
            getScopes() {
                this.$http.get('/oauth/scopes')
                        .then(response => {
                            this.scopes = response.data;
                        });
            },

            /**
             * Show the form for creating new tokens.
             */
            showCreateTokenForm() {
                $('#modal-create-token').modal('show');
            },

            /**
             * Create a new personal access token.
             */
            store() {
                this.accessToken = null;

                this.form.errors = [];

                this.$http.post('/oauth/personal-access-tokens', this.form)
                        .then(response => {
                            this.form.name = '';
                            this.form.scopes = [];
                            this.form.errors = [];

                            this.tokens.push(response.data.token);

                            this.showAccessToken(response.data.accessToken);
                        })
                        .catch(response => {
                            if (typeof response.data === 'object') {
                                this.form.errors = _.flatten(_.toArray(response.data));
                            } else {
                                this.form.errors = ['Something went wrong. Please try again.'];
                            }
                        });
            },

            /**
             * Toggle the given scope in the list of assigned scopes.
             */
            toggleScope(scope) {
                if (this.scopeIsAssigned(scope)) {
                    this.form.scopes = _.reject(this.form.scopes, s => s == scope);
                } else {
                    this.form.scopes.push(scope);
                }
            },

            /**
             * Determine if the given scope has been assigned to the token.
             */
            scopeIsAssigned(scope) {
                return _.indexOf(this.form.scopes, scope) > 0;
            },

            /**
             * Show the given access token to the user.
             */
            showAccessToken(accessToken) {
                $('#modal-create-token').modal('hide');

                this.accessToken = accessToken;

                $('#modal-access-token').modal('show');
            },

            /**
             * Revoke the given token.
             */
            revoke(token) {
                this.$http.delete('/oauth/personal-access-tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });
            }
        }
    }
</script>
