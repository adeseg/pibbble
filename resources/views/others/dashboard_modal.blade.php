  <!-- Hire Modal -->
  <div class="modal fade" id="myHire" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
          @if(Auth::user())
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Contact {{ Auth::user()->username }} about Work</h4>
          </div>
          <div class="modal-body">
            <p>From:   <img class="avatar" src="{{ Auth::user()->getAvatar() }}" /> {{ Auth::user()->username }}

            <hr>
            <p>To:     <img class="avatar" src="{{ $user->getAvatar() }}" /> {{ $user->username }}

            <hr>
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="message"><span class="glyphicon glyphicon-envelope"></span> Type Message Here</label>
                <textarea type="text" class="form-control" id="message" placeholder="Mail to"></textarea>
            </div>
          </div>
          @else
              <div>Please log in to contact developer.</div>
          @endif
          <div class="modal-footer">
          <div class='emailInfo alert alert-info' id='emailInfoDiv'>
                {{ $user->username }} will be notified shortly.
              <i class="fa fa-circle-o-notch fa-spin"></i>
          </div>
          <div class='emailResponse alert alert-success'>
              {{$user->username}} has been notified with your message. You can close this dialog.
          </div>
            <button type="button" id="hireme" data-id="{{ $user->id }}" class="btn btn-primary">Send</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
  </div>

  <!-- Upload Modal -->
  <div class="modal fade" id="myUpload" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Upload Project</h4>
        </div>
        <div class="modal-body">
          <form id="uploadForm" role="form-group" method="post" action="{{ route('projects.store') }}" onsubmit="showLoader()">
            <div class="form-group">
              <label for="name"><span class="glyphicon glyphicon-file"></span> Project Name</label>
              <input type="text" name="name" class="form-control" id="name" required>
              @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
              <label for="description"><span class="glyphicon glyphicon-blackboard"></span> Description</label>
              <textarea type="text" name="description" class="form-control" id="description" minlength="15"></textarea>
              @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
              <label for="technologies"><span class="glyphicon glyphicon-cog"></span> Technologies</label>
              <input type="text" name="technologies" class="form-control" id="technologies" required>
              @if ($errors->has('technologies'))
                    <span class="help-block">{{ $errors->first('technologies') }}</span>
                @endif
            </div>
            <div class="form-group">
              <label for="upload"><span class="glyphicon glyphicon-upload"></span> URL</label><br />
              <input type="text" name="project_url" class="form-control" id="upload" placeholder="e.g http://www.example.com" required pattern="https?://.+">
              @if ($errors->has('project_url'))
                    <span class="help-block">{{ $errors->first('project_url') }}</span>
                @endif
              <div id="errors" class="red_message"></div>
              <br>
            </div>
        <div class="modal-footer">
          <div class="pull-left">
            <img src='/img/33.gif' style="display:none;" id="form-load-img"/>
          </div>
          <button type="submit" class="btn btn-primary" id="uploadSubmit">Upload</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    </div>
      </div>
    </div>
  </div>

  <!-- Bio Modal -->
  <div class="modal fade" id="myBio" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bio</h4>
              </div>
              <div class="modal-body">
              @if($user->bio)
                <p>{{ $user->bio }}</p>
              @else
                <p>Bio is yet to be updated</p>
              @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
          </div>

      </div>
  </div>

  <!--Edit Modal-->

  <div class="modal fade" id="myEdit" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Project</h4>
        </div>
        <div class="modal-body">
          <form id="editForm" role="form-group" method="post" action="{{ route('projects.update') }}" onsubmit="showLoader()">
            <div class="form-group">
              <label for="name"><span class="glyphicon glyphicon-file"></span> Name</label>
              <input type="text" name="projectname" class="form-control" id="editname" value="">
              @if ($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
              <label for="description"><span class="glyphicon glyphicon-blackboard"></span> Description</label>
              <textarea type="text" name="description" class="form-control" id="editdescription"  ></textarea>
              @if ($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
            </div>
            <div class="form-group">
              <label for="technologies"><span class="glyphicon glyphicon-cog"></span> Technologies</label>
              <input type="text" name="technologies" class="form-control" id="edittechnologies"  value="">
              @if ($errors->has('technologies'))
                    <span class="help-block">{{ $errors->first('technologies') }}</span>
                @endif
            </div>
        </div>
        <div class="modal-footer">
          <div class="pull-left">
            <img src='/img/33.gif' style="display:none;" id="form-load-img"/>
          </div>
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
      </div>
    </div>
  </div>

<!-- Skills Modal -->
<div class="modal fade" id="mySkills" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Skills</h4>
            </div>
            <div class="modal-body">
                @if($user->skills)
                @foreach(explode(', ', $user->skills) as $skill)
                    <button class="btn btn-md">{{ $skill }}</button>
                @endforeach
                @else
                    <p>No Skill updated yet!</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Ajax Modal-->
<div class="modal fade" id="ajaxModal" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Following/Unfollow Ajax</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
