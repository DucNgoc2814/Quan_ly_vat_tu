 @extends('client.layouts.master')
 @section('content')
     <div class="review-wrapper" style="display: flex; justify-content: center; align-items: center; ">
         <div class="review border-default universal-padding mt-30 " magin-left: 30px;>
             <h2 class="review-title mb-30">Bạn đang xem xét: <br><span>Go-Get'r Pushup Grips</span></h2>
             <p class="review-mini-title">Đánh giá của bạn</p>
             <ul class="review-list">
                 <!-- Single Review List Start -->
                 <li>
                     <span>Chất lượng</span>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star-o"></i>
                     <i class="fa fa-star-o"></i>
                 </li>
                 <!-- Single Review List End -->
                 <!-- Single Review List Start -->
                 <li>
                     <span>Giá</span>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star-o"></i>
                     <i class="fa fa-star-o"></i>
                     <i class="fa fa-star-o"></i>
                 </li>
                
                 <!-- Single Review List End -->
             </ul>
             <!-- Reviews Field Start -->
             <div class=" mt-40">
                 <form  action="{{route('feedback.store')}}" method="POST">
                    @csrf
                     <div class="row">
                         <div class="col-lg-12">
                             <label class="req" for="sure-name">Tên</label>
                             <input type="text" class="form-control" name="name"  >
                         </div>
                         <div class="col-lg-12">
                             <label class="req" for="email">email</label>
                             <input type="text" class="form-control" name="email" >
                         </div>
                         <div class="col-lg-12">
                            <label class="req" for="subject">SĐT</label>
                            <input type="text" class="form-control" name="number_phone" >
                        </div>
                         <div class="col-lg-12">
                             <label class="req" for="content">Nội dung đánh giá</label>
                             <textarea class="form-control" rows="5" name="content"></textarea> <br>
                         </div>
                         <div class="col-lg-12">
                            <label class="req" for="content">Ngày Phản hồi</label>
                            <input type="date" class="form-control" rows="5" name="created_at"> <br>
                        </div>
                     </div>
                     <div class="mt-3" style="justify-content: center; display: flex;">
                         <button type="submit" class="btn btn-success ">Submit</button>
                     </div>
                 </form>
             </div>
             <!-- Reviews Field Start -->
         </div>
     </div>
 @endsection
