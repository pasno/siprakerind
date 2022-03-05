    <div id="new-task" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add new task</h4>
                </div>
                <form action="#" class='new-task-form form-horizontal form-bordered'>
                    <div class="modal-body nopadding">
                        <div class="form-group">
                            <label for="tasktitel" class="col-sm-3 control-label">Icon</label>
                            <div class="col-sm-9">
                                <select name="icons" id="icons" class='select2-me input-xlarge'>
                                    <option value="adjust">icon-adjust</option>
                                    <option value="asterisk">icon-asterisk</option>
                                    
                                    <option value="pinterest">icon-pinterest</option>
                                    <option value="pinterest-sign">icon-pinterest-sign</option>
                                    <option value="google-plus">icon-google-plus</option>
                                    <option value="google-plus-sign">icon-google-plus-sign</option>
                                    <option value="sign-blank">icon-sign-blank</option>
                                    <option value="ambulance">icon-ambulance</option>
                                    <option value="beaker">icon-beaker</option>
                                    <option value="h-sign">icon-h-sign</option>
                                    <option value="hospital">icon-hospital</option>
                                    <option value="medkit">icon-medkit</option>
                                    <option value="plus-sign-alt">icon-plus-sign-alt</option>
                                    <option value="stethoscope">icon-stethoscope</option>
                                    <option value="user-md">icon-user-md</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="task-name" class="col-sm-3 control-label">Task</label>
                            <div class="col-sm-9">
                                <input type="text" name="task-name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tasktitel" class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <label class="checkbox">
                                    <input type="checkbox" name="task-bookmarked" value="yep">Mark as important</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Add task">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="modal-user" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Jane Doe</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-2">
                            <img src="img/demo/user-1.jpg" alt="">
                        </div>
                        <div class="col-sm-10">
                            <dl class="dl-horizontal" style="margin-top:0;">
                                <dt>Full name:</dt>
                                <dd>Jane Doe</dd>
                                <dt>Email:</dt>
                                <dd>jane.doe@janedoesemail.com</dd>
                                <dt>Address:</dt>
                                <dd>
                                    <address>
                                        <strong>John Doe, Inc.</strong>
                                        <br>7195 JohnsonDoes Ave, Suite 320
                                        <br>San Francisco, CA 881234
                                        <br>
                                        <abbr title="Phone">P:</abbr>
                                        (123) 456-7890
                                    </address>
                                </dd>
                                <dt>Social:</dt>
                                <dd>
                                    <a href="#" class='btn'>
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                    <a href="#" class='btn'>
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                    <a href="#" class='btn'>
                                        <i class="fa fa-linkedin"></i>
                                    </a>
                                    <a href="#" class='btn'>
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    <a href="#" class='btn'>
                                        <i class="fa fa-rss"></i>
                                    </a>
                                    <a href="#" class='btn'>
                                        <i class="fa fa-github"></i>
                                    </a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="navigation">
        <div class="container-fluid">
            <a href="#" id="brand">FLAT</a>
            <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
                <i class="fa fa-bars"></i>
            </a>
            <ul class='main-nav'>
                
            </ul>
            <div class="user">
                <ul class="icon-nav">
                    <li class="dropdown sett">
                        <a href="#" class='dropdown-toggle' data-toggle="dropdown">
                            <i class="fa fa-cog"></i>
                        </a>
                        <ul class="dropdown-menu pull-right theme-settings">
                            <li>
                                <span>Layout-width</span>
                                <div class="version-toggle">
                                    <a href="#" class='set-fixed'>Fixed</a>
                                    <a href="#" class="active set-fluid">Fluid</a>
                                </div>
                            </li>
                            <li>
                                <span>Topbar</span>
                                <div class="topbar-toggle">
                                    <a href="#" class='set-topbar-fixed'>Fixed</a>
                                    <a href="#" class="active set-topbar-default">Default</a>
                                </div>
                            </li>
                            <li>
                                <span>Sidebar</span>
                                <div class="sidebar-toggle">
                                    <a href="#" class='set-sidebar-fixed'>Fixed</a>
                                    <a href="#" class="active set-sidebar-default">Default</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class='dropdown colo'>
                        <a href="#" class='dropdown-toggle' data-toggle="dropdown">
                            <i class="fa fa-tint"></i>
                        </a>
                        <ul class="dropdown-menu pull-right theme-colors">
                            <li class="subtitle">
                                Predefined colors
                            </li>
                            <li>
                                <span class='red'></span>
                                <span class='orange'></span>
                                <span class='green'></span>
                                <span class="brown"></span>
                                <span class="blue"></span>
                                <span class='lime'></span>
                                <span class="teal"></span>
                                <span class="purple"></span>
                                <span class="pink"></span>
                                <span class="magenta"></span>
                                <span class="grey"></span>
                                <span class="darkblue"></span>
                                <span class="lightred"></span>
                                <span class="lightgrey"></span>
                                <span class="satblue"></span>
                                <span class="satgreen"></span>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="dropdown">
                    <a href="#" class='dropdown-toggle' data-toggle="dropdown">Pasno
                        <img src="assets/img/demo/user-avatar.jpg" alt="">
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="#">Account settings</a>
                        </li>
                        <li>
                            <a href="more-login.html">Sign out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>