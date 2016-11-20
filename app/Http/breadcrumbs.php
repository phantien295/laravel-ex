<?php

// Home
Breadcrumbs::register('dashboard', function($breadcrumbs){
    $breadcrumbs->push('Dashboard', url('dashboard'));
});

Breadcrumbs::register('listbook', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Quản lý sách', url('admin/listbook'));
});

Breadcrumbs::register('order', function($breadcrumbs){
	// $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Danh sách hóa đơn', url('admin/order'));
});

Breadcrumbs::register('orderdetail', function($breadcrumbs){
	$breadcrumbs->parent('order');
    $breadcrumbs->push('Chi tiết hóa đơn', url('admin/orderdetail'));
});
//Danh sách thể loại
Breadcrumbs::register('listcat', function($breadcrumbs){
	$breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Danh sách thể loại', url('admin/listcat'));
});
//Sách theo thể loại
Breadcrumbs::register('bookcat', function($breadcrumbs){
	$breadcrumbs->parent('listcat');
    $breadcrumbs->push('Sách theo thể loại', url('admin/bookcat'));
});
//Danh sách người dùng
Breadcrumbs::register('userlist', function($breadcrumbs){
    // $breadcrumbs->parent('listcat');
    $breadcrumbs->push('Danh sách người dùng', url('admin/user'));
});
//Hóa đơn theo người dùng
Breadcrumbs::register('userorder', function($breadcrumbs){
    $breadcrumbs->parent('userlist');
    $breadcrumbs->push('Hóa đơn của người dùng', url('admin/userorder'));
});
// // Home > About
// Breadcrumbs::register('about', function($breadcrumbs)
// {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('About', route('about'));
// });

// // Home > Blog
// Breadcrumbs::register('blog', function($breadcrumbs)
// {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('Blog', route('blog'));
// });

// // Home > Blog > [Category]
// Breadcrumbs::register('category', function($breadcrumbs, $category)
// {
//     $breadcrumbs->parent('blog');
//     $breadcrumbs->push($category->title, route('category', $category->id));
// });

// // Home > Blog > [Category] > [Page]
// Breadcrumbs::register('page', function($breadcrumbs, $page)
// {
//     $breadcrumbs->parent('category', $page->category);
//     $breadcrumbs->push($page->title, route('page', $page->id));
// });