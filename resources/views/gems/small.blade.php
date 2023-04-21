@extends('small_report_layout')
@section('content')
@for($i=1;$i<20;$i++)
  @foreach($gems as  $item)
    <div id="example2" class="sss">
      <img src="{{url('/'.$item->certi_front)}}" class="front-image">
       <table class="table-design font" >
          <tbody class="tbody-design">
            <center>
              {{ QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') }}
            </center>
            <tr>
              <td width="32%"><span class="s">&nbsp;&nbsp;&nbsp;Certificate No</span></td>
              <td width="43%"><span class="marg">{{$item->report_no}}</span></td>               
              <td style="width:5%" rowspan="2" style="white-space: nowrap;"><span class="description">{{$item->description}}</span></td>
            </tr> 

            @if($item->weight)
              <tr> 
                <td style=""><span class="s">&nbsp;&nbsp;&nbsp;Weight</span></td>
                <td style=""><span class="marg">{{$item->weight}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->weight_type}}</span></td>
                <td style="" colspan="1"><span>&nbsp;</span></td>
              </tr>
            @endif

            @if($item->shape_cut)
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Shape Cut</span></td>
                <td><span class="marg">{{$item->shape_cut}}</span></td>
                <td style="" colspan="1"><span>&nbsp;</span></td>
              </tr>
            @endif

            @if($item->measurement)
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Measurement</span></td>
                <td><span class="marg">{{$item->measurement}}&nbsp;&nbsp;&nbsp;{{$item->mesurement_type}}</span></td>
                <td style="" colspan="1"><span>&nbsp;</span></td>
              </tr> 
            @endif

            @if($item->color)
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Colour</span></td>
                <td colspan="3"><span class="marg">{{$item->color}}</span></td>
              </tr> 
            @endif      

            @if($item->optic_character)
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Optic Character</span></td>
                <td><span class="marg">{{$item->optic_character}}</span></td>
                <center><img class="product-image" src="{{url('/'.$item->prod_image)}}"/></center>
              </tr>
            @endif

            @if($item->ri)
              <tr>
                <td style=""><span class="s">&nbsp;&nbsp;&nbsp;Refractive Index</span></td>
                <td style="" colspan="2"><span class="marg">{{$item->ri}}</span></td>              
              </tr>
            @endif

            @if($item->sg)
              <tr>
                <td style=""><span class="s">&nbsp;&nbsp;&nbsp;Specific Garvity</span></td>
                <td style=""><span class="marg">{{$item->sg}}</span></td>
              </tr>
            @endif

            @if($item->microscopic_obs)
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Microscopic&nbsp;Obs:</span></td>
                <td><span class="marg">{{$item->microscopic_obs}}</span></td>
              </tr>
            @endif

            @if($item->species)
              <tr>
                <td><span class="s">&nbsp;&nbsp;&nbsp;Species</span></td>
                <td><span class="marg">{{$item->species}}</span></td>
              </tr>
            @endif

            @if($item->comments)
              <tr> 
                <td><span class="s">&nbsp;&nbsp;&nbsp;Comments</span></td>
                <td><span class="marg">{{$item->comments}}</span></td>
              </tr>
            @endif

            @if($item->result)
            <tr>
              <td colspan="2" class="box"><h3 class="result">{{$item->result}}</h3></td>
            </tr>
            @endif
          </tbody>
       </table>
    </div>
    
    <div id="exam2" class="back-img-div-top">
       <div class="back-img-div" >
          <img src="{{url('/'.$item->certi_back)}}" class="back-img">
       </div>
    </div>  
  @endforeach
  @endfor
@endsection


