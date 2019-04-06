@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">Similarity strings</div>
        </div>
        <form method="post" action="/">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control" name="stringOne" style="height: 150px;"
                                  title="String for similarity">{{$one??''}}</textarea>
                        <span id="countStringOne" style="color:green;"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <textarea class="form-control" name="stringTwo" style="height: 150px;"
                                  title="String for similarity">{{$two??''}}</textarea>
                        <span id="countStringTwo" style="color:green;"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @isset($algorithms)
                        <div class="form-group">
                            <select class="form-control" name="algorithm">
                                @foreach($algorithms as $name)
                                    <option value={{$name}} {{$preset === $name ? 'selected' : ''}}>
                                        {{str_replace('_',' ',$name)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endisset
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input
                            id="special" {{$special ? 'checked' : ''}}
                            class="form-check-input"
                            type="checkbox"
                            value="{{$special ? 1 : 0}}"
                            name="special"
                        >
                        <label class="form-check-label" for="special">
                            Use special character
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary">Calculate</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    @isset($stringsSimilarity)
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Result similarity strings</h3>
                            </div>
                            <ul class="list-group">
                                @foreach($stringsSimilarity as $algorithm => $similarity)
                                    <li class="list-group-item">
                                        {{ucfirst(str_replace('_',' ',$algorithm))}} : {{round($similarity, 2)*100}} %
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <script>
        document
          .getElementById('special')
          .addEventListener('change', checkedHandle, false);

        function checkedHandle () {
          this.value = this.checked ? 1 : 0;
        }

        const textareaAll = document.querySelectorAll('textarea');
        for (let i = 0; i < textareaAll.length; i++) {
            textareaAll[i].addEventListener('keyup', showCountCharacterHandler, false)
        }

        function showCountCharacterHandler () {
          const number = this.value.length;

          if (number !== 0) {
            const name =
              this.getAttribute('name').charAt(0).toUpperCase() +
              this.getAttribute('name').slice(1);
              document
                .getElementById('count' + name)
                .innerHTML = 'Count character: ' + number;
          }
        }
    </script>
@endsection
