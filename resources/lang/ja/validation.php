<?php

return [

/*
|--------------------------------------------------------------------------
| Validation Language Lines
|--------------------------------------------------------------------------
|
| The following language lines contain the default error messages used by
| the validator class. Some of these rules have multiple versions such
| as the size rules. Feel free to tweak each of these messages here.
|
*/

'accepted' => ':attributeは同意する必要があります。',
'active_url' => ':attributeは有効なURLではありません。',
'after' => ':attributeは:dateより後の日付である必要があります。',
'after_or_equal' => ':attributeは:date以降の日付である必要があります。',
'alpha' => ':attributeには英字のみを入力してください。',
'alpha_dash' => ':attributeには英数字、ハイフン、アンダースコアのみを入力してください。',
'alpha_num' => ':attributeには英数字のみを入力してください。',
'array' => ':attributeは配列でなければなりません。',
'before' => ':attributeは:dateより前の日付である必要があります。',
'before_or_equal' => ':attributeは:date以前の日付である必要があります。',
'between' => [
'numeric' => ':attributeは:min〜:maxの間でなければなりません。',
'file' => ':attributeは:min〜:maxキロバイトの間でなければなりません。',
'string' => ':attributeは:min〜:max文字の間でなければなりません。',
'array' => ':attributeは:min〜:max個の間でなければなりません。',
],
'boolean' => ':attributeフィールドは true か false のいずれかである必要があります。',
'confirmed' => ':attributeが確認用と一致しません。',
'date' => ':attributeは有効な日付ではありません。',
'date_equals' => ':attributeは:dateと等しい日付でなければなりません。',
'date_format' => ':attributeは:format形式と一致しません。',
'different' => ':attributeと:otherは異なる必要があります。',
'digits' => ':attributeは:digits桁である必要があります。',
'digits_between' => ':attributeは:min〜:max桁の間である必要があります。',
'dimensions' => ':attributeは無効な画像サイズです。',
'distinct' => ':attributeフィールドに重複した値があります。',
'email' => ':attributeは有効なメールアドレスである必要があります。',
'ends_with' => ':attributeは次のいずれかで終わる必要があります :values。',
'exists' => '選択された:attributeは無効です。',
'file' => ':attributeはファイルでなければなりません。',
'filled' => ':attributeフィールドは必須です。',
'gt' => [
'numeric' => ':attributeは:valueより大きくなければなりません。',
'file' => ':attributeは:valueキロバイトより大きくなければなりません。',
'string' => ':attributeは:value文字より大きくなければなりません。',
'array' => ':attributeは:value個より多くのアイテムを持たなければなりません。',
],
'gte' => [
'numeric' => ':attributeは:value以上である必要があります。',
'file' => ':attributeは:valueキロバイト以上である必要があります。',
'string' => ':attributeは:value文字以上である必要があります。',
'array' => ':attributeは:value個以上のアイテムを持っている必要があります。',
],
'image' => ':attributeは画像でなければなりません。',
'in' => '選択された:attributeは無効です。',
'in_array' => ':attributeフィールドは:otherに存在しません。',
'integer' => ':attributeは整数でなければなりません。',
'ip' => ':attributeは有効なIPアドレスである必要があります。',
'ipv4' => ':attributeは有効なIPv4アドレスである必要があります。',
'ipv6' => ':attributeは有効なIPv6アドレスである必要があります。',
'json' => ':attributeは有効なJSON文字列である必要があります。',
'lt' => [
'numeric' => ':attributeは:valueより小さくなければなりません。',
'file' => ':attributeは:valueキロバイトより小さくなければなりません。',
'string' => ':attributeは:value文字より小さくなければなりません。',
'array' => ':attributeは:value個より少ないアイテムを持たなければなりません。',
],
'lte' => [
'numeric' => ':attributeは:value以下である必要があります。',
'file' => ':attributeは:valueキロバイト以下である必要があります。',
'string' => ':attributeは:value文字以下である必要があります。',
'array' => ':attributeは:value個以下のアイテムを持っている必要があります。',
],
'max' => [
'numeric' => ':attributeは:max以下でなければなりません。',
'file' => ':attributeは:maxキロバイト以下である必要があります。',
'string' => ':attributeは:max文字以下である必要があります。',
'array' => ':attributeは:max個以下のアイテムを持てます。',
],
'mimes' => ':attributeは以下のタイプのファイルでなければなりません：:values。',
'mimetypes' => ':attributeは以下のタイプのファイルでなければなりません：:values。',
'min' => [
'numeric' => ':attributeは少なくとも:minである必要があります。',
'file' => ':attributeは少なくとも:minキロバイトである必要があります。',
'string' => ':attributeは少なくとも:min文字である必要があります。',
'array' => ':attributeは少なくとも:min個のアイテムを持たなければなりません。',
],
'not_in' => '選択された:attributeは無効です。',
'not_regex' => ':attributeの形式が無効です。',
'numeric' => ':attributeは数値である必要があります。',
'password' => 'パスワードが正しくありません。',
'present' => ':attributeフィールドは存在している必要があります。',
'regex' => ':attributeは無効な形式です。',
'required' => ':attributeは必須です。',
'required_if' => ':otherが:valueの場合、:attributeフィールドは必須です。',
'required_unless' => ':valuesに含まれない限り、:attributeフィールドは必須です。',
'required_with' => ':valuesが存在する場合、:attributeフィールドは必須です。',
'required_with_all' => ':valuesが存在する場合、:attributeフィールドは必須です。',
'required_without' => ':valuesが存在しない場合、:attributeフィールドは必須です。',
'required_without_all' => ':valuesがすべて存在しない場合、:attributeフィールドは必須です。',
'same' => ':attributeと:otherは一致する必要があります。',
'size' => [
'numeric' => ':attributeは:sizeでなければなりません。',
'file' => ':attributeは:sizeキロバイトでなければなりません。',
'string' => ':attributeは:size文字でなければなりません。',
'array' => ':attributeは:size個のアイテムを含む必要があります。',
],
'starts_with' => ':attributeは次のいずれかで始まる必要があります :values。',
'string' => ':attributeは文字列である必要があります。',
'timezone' => ':attributeは有効なタイムゾーンである必要があります。',
'unique' => ':attributeはすでに使用されています。',
'uploaded' => ':attributeのアップロードに失敗しました。',
'url' => ':attributeは無効な形式です。',
'uuid' => ':attributeは有効なUUIDである必要があります。',

/*
|--------------------------------------------------------------------------
| Custom Validation Language Lines
|--------------------------------------------------------------------------
|
| Here you may specify custom validation messages for attributes using the
| convention "attribute.rule" to name the lines. This makes it quick to
| specify a specific custom language line for a given attribute rule.
|
*/

'custom' => [
'attribute-name' => [
'rule-name' => 'custom-message',
],
],

/*
|--------------------------------------------------------------------------
| Custom Validation Attributes
|--------------------------------------------------------------------------
|
| The following language lines are used to swap our attribute placeholder
| with something more reader friendly such as "E-Mail Address" instead
| of "email". This simply helps us make our message more expressive.
|
*/
'attributes' => [
'over_name' => '姓',
'under_name' => '名',
'over_name_kana' => 'セイ',
'under_name_kana' => 'メイ',
'mail_address' => 'メールアドレス',
'sex' => '性別',
'old_year' => '生年月日',
'role' => '役職',
'password' => 'パスワード',
// 'password_confirmation' => '確認用パスワード',
],

];
