<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Member;
use App\Models\User;
use App\Models\Position;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use ImageKit\ImageKit;

class AdminController extends Controller
{
  /**
   * << Admin Function >>
   * 
   * -------------------------------
   * @method editAdmin
   * @method updateAdmin
   * @method viewAdminDashboard
   * -------------------------------
   */
  public function editAdmin() {
    // Get all position
    $positions = Position::all();
    // Get Authenticated Admin
    $admin = Auth::user();
    return view('admin.edit_admin_profile_form', compact(['admin', 'positions']));
  }

  public function updateAdmin(Request $request, $id) {
    // Find member by ID
    $admin = User::findOrFail($id);

    // Validation check
    $validator = Validator::make($request->all(), [
      'profile_photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
      'full_name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'email',
        'unique:users,email,' . $id, 
      ],
      'position_id' => ['required', 'integer'],
      'password' => ['required', 'string'],
      'confirm_new_password' => ['required', 'string'],
      'current_password' => ['required', 'string'],
    ]);
    
    // Check if validation check fail
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->with('toast_error', 'Update Profile Admin gagal. Silakan periksa kembali input Anda.')
        ->withInput();
    }

    if (!Hash::check($request['current_password'], $admin->password)) {
      return redirect()->back()
        ->withErrors(['current_password' => 'Password lama tidak cocok.'])
        ->with('toast_error', 'Password lama tidak cocok.')
        ->withInput();
    }else if ($request['password'] != $request['confirm_new_password']) {
      return redirect()->back()
        ->withErrors(['confirm_new_password' => 'Konfirmasi password tidak cocok.'])
        ->with('toast_error', 'Konfirmasi password tidak cocok.')
        ->withInput();
    }

    // Get validated data from validator
    $validatedData = $validator->validated();
    // Upload profile image if there is an image
    if ($request->hasFile('profile_photo')) {
      // Delete profile image
      $this->deleteImagekitImage($admin->imagekit_file_id);
      // Add new profile image and get the imagekit url and file ID
      $imageData = $this->addImagekitImage($request, 'profile_photo', '/profile_photos');
      // Set the imagekit url and file ID into validated data
      $validatedData['profile_photo'] = $imageData['url'];
      $validatedData['imagekit_file_id'] = $imageData['file_id'];
    }
    
    // Update Admin
    $admin->update($validatedData);

    return redirect()
      ->route('admin.edit-admin-profile-form')
      ->with('toast_success', 'Profile Admin berhasil diperbarui!');
  }

  public function viewAdminDashboard(Request $request) {
    // Get filtered articles data and paginate into 10
    $recentArticles = $this->getFilteredArticlesQuery($request)
                            ->paginate(5)
                            ->withQueryString();

    return view('admin.dashboard', compact('recentArticles'));
  }

  public function viewHelpCenter() {
    // Get all FAQs
    $faqs = Faq::all();
    
    return view('admin.help_center', compact('faqs'));
  }


  /**
   * << Members Function >>
   * 
   * --------------------------------
   * @method createNewMember
   * @method storeNewMember
   * @method editMember
   * @method updateMember
   * @method deleteMember
   * @method viewAllMembers
   * @method getFilteredMembersQuery
   * --------------------------------
   */
  public function createNewMember() {
    $positions = Position::all();
    return view('admin.new_member_form', compact('positions'));
  }

  public function storeNewMember(Request $request) {
    // Check whether email is institutional
    if (!str_contains($request['email'], '@webmail.umm.ac.id')) {
      return back()->withErrors([
        'email' => 'Email wajib menggunakan domain @webmail.umm.ac.id.',
      ])->with('toast_error', 'Email wajib menggunakan domain @webmail.umm.ac.id.')
      ->withInput();
    }

    // Validation check
    $validator = Validator::make($request->all(), [
      'profile_photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
      'full_name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'email',
        'regex:/^[a-zA-Z0-9._%+-]+@webmail\.umm\.ac\.id$/',
        'unique:users,email',
      ],
      'position_id' => ['required', 'integer'],
    ]);

    // Check if validation check fail
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->with('toast_error', 'Penambahan Member gagal. Silakan periksa kembali input Anda.')
        ->withInput();
    }
    
    // Get validated data from validator
    $validatedData = $validator->validated();
    // Set join date to current date
    $validatedData['join_date'] = now()->format('Y-m-d');

    // Upload profile image if there is an image
    $imageData = $this->addImagekitImage($request, 'profile_photo', '/profile_photos');
    if(empty($imageData)) {
      return redirect()->back()
        ->with('toast_error', 'Gagal upload gambar')
        ->withInput();
    }
    
    // Set the imagekit url and file ID into validated data
    $validatedData['profile_photo'] = $imageData['url'];
    $validatedData['imagekit_file_id'] = $imageData['file_id'];

    // Save validated data into database
    Member::create($validatedData);

    return redirect()
      ->intended(route('admin.new-member-form'))
      ->with('toast_success', 'Member ' . $validatedData['full_name'] . ' berhasil ditambahkan !');
  } 

  public function editMember($id) {
    // Get all position
    $positions = Position::all();

    // Find member by ID
    $member = Member::findOrFail($id);
    return view('admin.edit_member_profile_form', compact(['member', 'positions']));
  }

  public function updateMember(Request $request, $id)
  {
    // Find member by ID
    $member = Member::findOrFail($id);

    // Validation check
    $validator = Validator::make($request->all(), [
      'profile_photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
      'full_name' => ['required', 'string', 'max:255'],
      'email' => [
        'required',
        'email',
        'regex:/^[a-zA-Z0-9._%+-]+@webmail\.umm\.ac\.id$/',
        'unique:members,email,' . $id, 
      ],
      'position_id' => ['required', 'integer'],
    ]);
    
    // Check if validation check fail
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->with('toast_error', 'Update Profile Member gagal. Silakan periksa kembali input Anda.')
        ->withInput();
    }

    // Get validated data from validator
    $validatedData = $validator->validated();
    // Upload profile image if there is an image
    if ($request->hasFile('profile_photo')) {
      // Delete profile image
      $this->deleteImagekitImage($member->imagekit_file_id);
      // Add new profile image and get the imagekit url and file ID
      $imageData = $this->addImagekitImage($request, 'profile_photo', '/profile_photos');
      // Set the imagekit url and file ID into validated data
      $validatedData['profile_photo'] = $imageData['url'];
      $validatedData['imagekit_file_id'] = $imageData['file_id'];
    }
    
    // Update member
    $member->update($validatedData);

    return redirect()
      ->route('admin.manage-members')
      ->with('toast_success', 'Member ' . $validatedData['full_name'] . ' berhasil diperbarui!');
  }

  public function deleteMember($id)
  {
    // Find member by ID
    $member = Member::findOrFail($id);
    // Delete profile image and member data from database
    $this->deleteImagekitImage($member->imagekit_file_id);
    $member->delete();

    return redirect()
      ->route('admin.manage-members')
      ->with('toast_success', $member->full_name . ' berhasil dihapus!');
  }

  public function viewAllMembers(Request $request) {
    // Paginate member data and set pagination to 1 with 1 side [CHANGE: Paginate into 10]
    $members = $this->getFilteredMembersQuery($request)
                      ->paginate(5)
                      ->onEachSide(5)
                      ->withQueryString();
    return view('admin.manage_members', compact('members'));
  }

  private function getFilteredMembersQuery(Request $request) {
    $query = Member::query();

    // Reading 'sort' parameter from URL dropdown
    switch ($request->get('sort')) {
      case 'oldest':
        $query->orderBy('created_at', 'asc');
        break;
      case 'name_asc':
        $query->orderBy('full_name', 'asc');
        break;  
      case 'name_desc':
        $query->orderBy('full_name', 'desc');
        break;
      case 'position_asc':
        $query->join('positions', 'members.position_id', '=', 'positions.id')
              ->orderBy('positions.position', 'asc');
        break;

      case 'position_desc':
        $query->join('positions', 'members.position_id', '=', 'positions.id')
              ->orderBy('positions.position', 'desc');
        break;
      case 'latest':
      default:
        $query->orderBy('created_at', 'desc');
        break;
    }

    return $query;
  }



  /**
   * << Articles Function >>
   * 
   * --------------------------------
   * @method createNewArticle
   * @method storeNewArticle
   * @method editArticle
   * @method updateArticle
   * @method deleteArticle
   * @method viewAllArticles
   * @method getFilteredArticlesQuery
   * --------------------------------
   */
  public function createNewArticle() {
    $categories = ArticleCategory::all();
    return view('admin.new_article_form', compact('categories'));
  }

  public function storeNewArticle(Request $request) {
    // Validation check
    $validator = Validator::make($request->all(), [
      'author_id' => ['required', 'integer', 'exists:users,id'],
      'category_id' => ['required', 'integer', 'exists:article_categories,id'],
      'title' => ['required', 'string', 'max:255'],
      'thumbnail_photo' => ['required', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
      'content' => ['required', 'string'],
      'tags' => ['required', 'json'],
      'status' => ['required', 'string'],
      'is_pinned' => ['nullable', 'boolean']
    ]);

    // Check if validation check fail
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->with('toast_error', 'Penambahan Article gagal. Silakan periksa kembali input Anda.')
        ->withInput();
    }
    
    // Get validated data from validator
    $validatedData = $validator->validated();
    // Upload profile image if there is an image
    $imageData = $this->addImagekitImage($request, 'thumbnail_photo', '/articles_thumbnail');
    if(empty($imageData)) {
      return redirect()->back()
        ->with('toast_error', 'Gagal upload gambar')
        ->withInput();
    }
    
    // Set the imagekit url and file ID into validated data
    $validatedData['thumbnail_photo'] = $imageData['url'];
    $validatedData['imagekit_file_id'] = $imageData['file_id'];
    // Decode tags JSON to array
    $validatedData['tags'] = json_decode($validatedData['tags'], true);

    // Save validated data into database
    Article::create($validatedData);

    return redirect()
      ->intended(route('admin.article-form'))
      ->with('toast_success', 'Article berhasil ditambahkan !');
  }

  public function editArticle($id) {
    // Get all categories
    $categories = ArticleCategory::all();
    // Get article by ID
    $article = Article::findOrFail($id);
    return view('admin.edit_article_form', compact(['article', 'categories']));
  }

  public function updateArticle(Request $request, $id) {
    // Find article by ID
    $article = Article::findOrFail($id);
    // Check if data has been updated (Data Synchronization check)
    if ($request->last_updated_at != $article->updated_at) {
      return redirect()->back()->withErrors(['msg' => 'Data telah diubah oleh orang lain. Silahkan refresh halaman.']);
    }

    // Validation check
    $validator = Validator::make($request->all(), [
      'author_id' => ['required', 'integer', 'exists:users,id'],
      'category_id' => ['required', 'integer', 'exists:article_categories,id'],
      'title' => ['required', 'string', 'max:255'],
      'thumbnail_photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
      'content' => ['required', 'string'],
      'tags' => ['required', 'json'],
      'status' => ['required', 'string'],
      'is_pinned' => ['nullable', 'boolean']
    ]);
    
    // Check if validation check fail
    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->with('toast_error', 'Update Article gagal. Silakan periksa kembali input Anda.')
        ->withInput();
    }

    // Get validated data from validator
    $validatedData = $validator->validated();
    // Decode tags JSON to array
    $validatedData['tags'] = json_decode($validatedData['tags'], true);
    // Update updated_at timestamp
    $validatedData['updated_at'] = now()->format('Y-m-d');

    // Upload thumbnail image if there is an image
    if ($request->hasFile('thumbnail_photo')) {
      // Delete thumbnail image
      $this->deleteImagekitImage($article->imagekit_file_id);
      // Add new thumbnail image and get the imagekit url and file ID
      $imageData = $this->addImagekitImage($request, 'thumbnail_photo', '/articles_thumbnail');
      // Set the imagekit url and file ID into validated data
      $validatedData['thumbnail_photo'] = $imageData['url'];
      $validatedData['imagekit_file_id'] = $imageData['file_id'];
    }
    
    // Update article
    $article->update($validatedData);

    return redirect()
      ->back()
      ->with('toast_success', 'Article berhasil diperbarui!');
  }

  public function deleteArticle($id) {
    // Find article by ID
    $article = Article::findOrFail($id);
    // Delete Article Thumbnail
    $this->deleteImagekitImage($article->imagekit_file_id);
    // Delete article
    $article->delete();
    // Return with success message
    return redirect()
      ->route('admin.manage-articles')
      ->with('toast_success', 'Article berhasil dihapus!');
  }

  public function viewAllArticles(Request $request) {
    // Get filtered articles data
    $articles = $this->getFilteredArticlesQuery($request)
                      ->paginate(10)  
                      ->withQueryString();

    return view('admin.manage_articles', compact('articles'));
  }

  private function getFilteredArticlesQuery(Request $request) {
    $query = Article::query();

    // Reading 'sort' parameter from URL dropdown
    switch ($request->get('sort')) {
      case 'oldest':
        $query->orderBy('created_at', 'asc');
        break;
      case 'title_asc':
        $query->orderBy('title', 'asc');
        break;
      case 'title_desc':
        $query->orderBy('title', 'desc');
        break;
      case 'status_asc':
        $query->orderBy('status', 'asc');
        break;
      case 'status_desc':
        $query->orderBy('status', 'desc');
        break;
      case 'latest':
      default:
        $query->orderBy('created_at', 'desc');
        break;
    }
    return $query;
  }



  /**
   * << Imagekit Upload Function >>
   * 
   * --------------------------------
   * @method addImagekitImage
   * @method deleteImagekitImage
   * --------------------------------
   */

  // << Imagekit Upload Function >>
  public function addImagekitImage(Request $request, string $fieldName, string $folder)
  {
    // Initialize ImageKit
    $imageKit = new ImageKit(
      env('IMAGEKIT_PUBLIC_KEY'),
      env('IMAGEKIT_PRIVATE_KEY'),
      env('IMAGEKIT_URL_ENDPOINT')
    );

    // Check if there is an image
    if ($request->hasFile($fieldName)) {
      // Get the image file
      $imageFile = $request->file($fieldName);
      /**
       * Take the image file
       * Convert image into Base64 string (Requirement for ImageKit)
       * Name the file based on current time and image name
       */
      $upload = $imageKit->uploadFile([
        'file' => base64_encode(file_get_contents($imageFile)),
        'fileName' => time() . '_' . $imageFile->getClientOriginalName(),
        'folder' => $folder
      ]);

      return [
        'url' => $upload->result->url,
        'file_id' => $upload->result->fileId,
      ];
    }

    return null;
  }

  // << Imagekit Delete Function >>
  public function deleteImagekitImage($imagekit_file_id)
  {
    // Check if there is an imagekit_file_id
    if (!$imagekit_file_id) return;

    // Initialize ImageKit
    $imageKit = new ImageKit(
      env('IMAGEKIT_PUBLIC_KEY'),
      env('IMAGEKIT_PRIVATE_KEY'),
      env('IMAGEKIT_URL_ENDPOINT')
    );

    // Try to delete the file from ImageKit, else return with error message
    try {
      $imageKit->deleteFile($imagekit_file_id);
    } catch (\Exception $e) {
      return back()->with('toast_error', 'Gagal menghapus foto profil. Silakan coba lagi.');
    }
  }
}
