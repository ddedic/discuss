<li class="comment" id="comment-@{{ comment.id }}" v-class="collapsed: collapsed" v-transition="fade">
    <div class="comment-content clearfix" v-class="target: target === comment.id">
        <div class="indicator"></div>

        <div v-if="comment.author.avatar" class="avatar">
            <a v-attr="href: comment.author.url">
                <img v-attr="src: comment.author.avatar" alt="@{{ comment.author.name }}">
            </a>
        </div>

        <div class="comment-body">
            <div>
                <span v-if="!comment.author.url" class="author">@{{ comment.author.name }}</span>
                <a v-if="comment.author.url" href="@{{ comment.author.url }}" target="_blank" class="author">@{{ comment.author.name }}</a>

                <a v-if="parent" href="#!comment=@{{ parent.id }}"
                    title="in reply to @{{ parent.author.name }}"
                    v-on="click: target = parent.id"
                >
                    <span class="glyphicon glyphicon-share-alt"></span>
                    @{{ parent.author.name }}
                </a>

                <a href="#!comment=@{{ comment.id }}" class="time-ago" v-on="click: target = comment.id">
                    <time datetime="@{{ comment.created_at }}" title="@{{ comment.created_at }}"></time>
                </a>

                <!-- Dropdown -->
                <div class="pull-right dropdown">
                    <span class="collapse" title="@lang('comments::all.collapse')" v-on="click: collapsed = true">−</span>
                    <span class="expand" title="@lang('comments::all.expand')" v-on="click: collapsed = false">+</span>

                    <div v-if="editable" class="edit-menu">
                        <span class="sep"></span>
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </div>
                        <ul class="dropdown-menu">
                            <template v-if="moderate">
                                <li><a href="@{{ comment.edit_link }}">@lang('comments::all.edit')</a></li>
                                <li><a href="#" v-on="click: edit">@lang('comments::all.qedit')</a></li>
                            </template>
                            <li v-if="!moderate">
                                <a href="#" class="quick-edit" v-on="click: edit">@lang('comments::all.edit')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="comment-body-inner" v-show="!showEdit">
                <div v-if="comment.status !== 'approved'" class="hold">@lang('comments::all.hold')</div>
                <div class="comment-message">@{{{ comment.contentHTML | emoji }}}</div>
            </div>

            <!-- Votes -->
            <div v-if="!showEdit">
                <div class="comment-voting" v-if="config.votes">
                    <span class="upvotes">@{{ comment.upvotes || '' }}</span>
                    <a href="#" title="@lang('comments::all.upvote')" class="upvote" v-class="voted: upvoted" v-on="click: upvote">
                        <span class="glyphicon glyphicon-chevron-up"></span></a>
                    <span class="sep"></span>
                    <span class="downvotes">@{{ comment.downvotes || '' }}</span>
                    <a href="#" title="@lang('comments::all.downvote')" class="downvote" v-class="voted: downvoted" v-on="click: downvote">
                        <span class="glyphicon glyphicon-chevron-down"></span></a>
                </div>

                <a v-if="config.replies" v-on="click: reply" href="#" class="reply">@lang('comments::all.reply')</a>
            </div>

            <!-- Edit form -->
            <form class="clearfix" v-if="showEdit" v-on="submit: save">
                <div class="form-group">
                    <textarea v-model="content" class="form-control" wrap="hard" maxlength="@{{ config.maxLength }}"
                              placeholder="@lang('comments::all.comment')" v-disable="loading"
                    >@{{{ comment.content }}}</textarea>
                </div>

                <div class="pull-left">
                    <button type="submit" class="btn btn-success btn-sm" v-loading="{state: loading, text: '@lang('comments::all.saving')'}">
                        @lang('comments::all.save')
                    </button>

                    <button type="button" class="btn btn-default btn-sm" v-on="click: showEdit = false">
                        @lang('comments::all.cancel')
                    </button>
                </div>

                <div class="pull-right" v-if="config.maxLength">
                    <span class="char-count">@{{ config.maxLength - content.length }}</span>
                </div>

                <alert errors="@{{ errors }}"></alert>
            </form>
        </div>

        <post v-if="showReply" focus="true" config="@{{ config }}" show="@{{@ showReply }}" parent="@{{ comment }}" total="@{{@ total }}"></post>
    </div>

    <ul class="comment-list children">
        <comment v-show="comment.replies" v-repeat="comment: comment.replies" total="@{{@ total }}"
                 parent="@{{@ comment }}" target="@{{@ target }}" config="@{{ config }}"
        ></comment>
    </ul>
</li>
