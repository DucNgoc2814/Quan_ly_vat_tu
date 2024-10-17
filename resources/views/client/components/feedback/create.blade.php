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
                 <!-- Single Review List Start -->
                 <li>
                     <span>Giá trị</span>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star"></i>
                     <i class="fa fa-star-o"></i>
                 </li>
                 <!-- Single Review List End -->
             </ul>
             <!-- Reviews Field Start -->
             <div class=" mt-40">
                 <form autocomplete="off" action="#">
                     <div class="row">
                         <div class="col-lg-12">
                             <label class="req" for="sure-name">Tên</label>
                             <input type="text" class="form-control" id="sure-name" required="required">
                         </div>
                         <div class="col-lg-12">
                             <label class="req" for="subject">email</label>
                             <input type="text" class="form-control" id="subject" required="required">
                         </div>
                         <div class="col-lg-12">
                             <label class="req" for="comments">Nội dung đánh giá</label>
                             <textarea class="form-control" rows="5" id="comments" required="required"></textarea> <br>
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
