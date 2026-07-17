<?php

namespace App\Enums;

enum FaqType: string {
    case ARTICLES = 'articles';
    case MEMBER_MANAGEMENTS = 'member_managements';
    case ACCOUNT_SAFETY = 'account_safety';
    case QUICK_FAQS = 'quick_faqs';
}
