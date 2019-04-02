var Comment = require('../models/comment');
var Campground = require('../models/campground');
module.exports = {
  isLoggedIn: function(req, res, next){
      if(req.isAuthenticated()){
          return next();
      }
      req.flash('error', 'Whoops! You must be logged in to do that.');
      res.redirect('/login');
  },
  checkUserCampground: function(req, res, next){
    Campground.findById(req.params.id, function(err, foundCampground){
      if(err || !foundCampground){
          console.log(err);
          req.flash('error', 'Whoops! Campground not found.');
          res.redirect('/campgrounds');
      } else if(foundCampground.author.id.equals(req.user._id)){
          req.campground = foundCampground;
          next();
      } else {
          req.flash('error', 'Whoops! You do not have permission to do that.');
          res.redirect('/campgrounds/' + req.params.id);
      }
    });
  },
  checkUserComment: function(req, res, next){
    Comment.findById(req.params.commentId, function(err, foundComment){
       if(err || !foundComment){
           console.log(err);
           req.flash('error', 'Whoops! Campground not found.');
           res.redirect('/campgrounds');
       } else if(foundComment.author.id.equals(req.user._id)){
            req.comment = foundComment;
            next();
       } else {
           req.flash('error', 'You don\'t have permission to do that!');
           res.redirect('/campgrounds/' + req.params.id);
       }
    });
  },
  isSafe: function(req, res, next) {
    if(req.body.image.match(/^https:\/\/images\.unsplash\.com\/.*/)) {
      next();
    }else {
      req.flash('error', 'Only images from images.unsplash.com allowed.\nSee https://youtu.be/Bn3weNRQRDE for how to copy image urls from unsplash.');
      res.redirect('back');
    }
  }
}