<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    const TYPE_DEFAULT = 'default';
    const TYPE_THUMB = 'thumb';
    const TYPE_ADMIN = 'admin';
    const TYPE_CATEGORY_COVER = 'category-cover';
    const TYPE_AVATAR = 'avatar';
    const TYPE_AVATAR_BIG = 'avatar-big';
    const TYPE_BLOG_CONTENT_DETAIL_PAGE = 'blog-content-detail-page';

    public function getUrl($type = self::TYPE_DEFAULT, $height = null)
    {
        $url = config('app.url').'/images'.$this->path;
        if (null !== $height && is_numeric($height)) {
            $url .= '?w='.$type.'&h='.$height.'&fit=crop-center';
        } else {
            switch ($type) {
                case self::TYPE_THUMB:
                case self::TYPE_ADMIN:
                    $url .= '?w=100&fit=crop-center';
                    break;
                case self::TYPE_BLOG_CONTENT_DETAIL_PAGE:
                    $url .= '?w=730&h=399&fit=crop-center';
                    break;
                case self::TYPE_CATEGORY_COVER:
                    $url .= '?w=350&h=285&fit=crop-center';
                    break;
                case self::TYPE_AVATAR:
                    $url .= '?w=50&h=50&fit=crop-center';
                    break;
                case self::TYPE_AVATAR_BIG:
                    $url .= '?w=148&h=148&fit=crop-center';
                    break;
            }
        }

        return $url;
    }
}
