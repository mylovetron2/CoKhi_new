<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class ck_chitiet_suachua_edit extends ck_chitiet_suachua
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'ck_chitiet_suachua';

	// Page object name
	public $PageObjName = "ck_chitiet_suachua_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (ck_chitiet_suachua)
		if (!isset($GLOBALS["ck_chitiet_suachua"]) || get_class($GLOBALS["ck_chitiet_suachua"]) == PROJECT_NAMESPACE . "ck_chitiet_suachua") {
			$GLOBALS["ck_chitiet_suachua"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ck_chitiet_suachua"];
		}

		// Table object (ck_danhmuc_suachua)
		if (!isset($GLOBALS['ck_danhmuc_suachua']))
			$GLOBALS['ck_danhmuc_suachua'] = new ck_danhmuc_suachua();

		// Table object (nhan_vien)
		if (!isset($GLOBALS['nhan_vien']))
			$GLOBALS['nhan_vien'] = new nhan_vien();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ck_chitiet_suachua');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (nhan_vien)
		$UserTable = $UserTable ?: new nhan_vien();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $ck_chitiet_suachua;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ck_chitiet_suachua);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "ck_chitiet_suachuaview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
		$Security->UserID_Loading();
		$Security->loadUserID();
		$Security->UserID_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("ck_chitiet_suachualist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
			if ($Security->isLoggedIn()) {
				$Security->UserID_Loading();
				$Security->loadUserID();
				$Security->UserID_Loaded();
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->sua_chua_id->Visible = FALSE;
		$this->tennhanvien->Visible = FALSE;
		$this->nhan_vien_id->setVisibility();
		$this->chuc_danh->setVisibility();
		$this->ngay_sua_chua->setVisibility();
		$this->thoi_gian->setVisibility();
		$this->noi_dung->setVisibility();
		$this->Picture->Visible = FALSE;
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->sua_chua_id);
		$this->setupLookupOptions($this->tennhanvien);
		$this->setupLookupOptions($this->nhan_vien_id);
		$this->setupLookupOptions($this->chuc_danh);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ck_chitiet_suachualist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->id->setOldValue($this->id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id->setQueryStringValue(Route(2));
				$this->id->setOldValue($this->id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id")) {
					$this->id->setFormValue($CurrentForm->getValue("x_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id") !== NULL) {
					$this->id->setQueryStringValue(Get("id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id->CurrentValue = NULL;
				}
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("ck_chitiet_suachualist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "ck_chitiet_suachualist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nhan_vien_id' first before field var 'x_nhan_vien_id'
		$val = $CurrentForm->hasValue("nhan_vien_id") ? $CurrentForm->getValue("nhan_vien_id") : $CurrentForm->getValue("x_nhan_vien_id");
		if (!$this->nhan_vien_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nhan_vien_id->Visible = FALSE; // Disable update for API request
			else
				$this->nhan_vien_id->setFormValue($val);
		}

		// Check field name 'chuc_danh' first before field var 'x_chuc_danh'
		$val = $CurrentForm->hasValue("chuc_danh") ? $CurrentForm->getValue("chuc_danh") : $CurrentForm->getValue("x_chuc_danh");
		if (!$this->chuc_danh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->chuc_danh->Visible = FALSE; // Disable update for API request
			else
				$this->chuc_danh->setFormValue($val);
		}

		// Check field name 'ngay_sua_chua' first before field var 'x_ngay_sua_chua'
		$val = $CurrentForm->hasValue("ngay_sua_chua") ? $CurrentForm->getValue("ngay_sua_chua") : $CurrentForm->getValue("x_ngay_sua_chua");
		if (!$this->ngay_sua_chua->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ngay_sua_chua->Visible = FALSE; // Disable update for API request
			else
				$this->ngay_sua_chua->setFormValue($val);
			$this->ngay_sua_chua->CurrentValue = UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 7);
		}

		// Check field name 'thoi_gian' first before field var 'x_thoi_gian'
		$val = $CurrentForm->hasValue("thoi_gian") ? $CurrentForm->getValue("thoi_gian") : $CurrentForm->getValue("x_thoi_gian");
		if (!$this->thoi_gian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->thoi_gian->Visible = FALSE; // Disable update for API request
			else
				$this->thoi_gian->setFormValue($val);
		}

		// Check field name 'noi_dung' first before field var 'x_noi_dung'
		$val = $CurrentForm->hasValue("noi_dung") ? $CurrentForm->getValue("noi_dung") : $CurrentForm->getValue("x_noi_dung");
		if (!$this->noi_dung->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->noi_dung->Visible = FALSE; // Disable update for API request
			else
				$this->noi_dung->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->nhan_vien_id->CurrentValue = $this->nhan_vien_id->FormValue;
		$this->chuc_danh->CurrentValue = $this->chuc_danh->FormValue;
		$this->ngay_sua_chua->CurrentValue = $this->ngay_sua_chua->FormValue;
		$this->ngay_sua_chua->CurrentValue = UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 7);
		$this->thoi_gian->CurrentValue = $this->thoi_gian->FormValue;
		$this->noi_dung->CurrentValue = $this->noi_dung->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->sua_chua_id->setDbValue($row['sua_chua_id']);
		$this->tennhanvien->setDbValue($row['tennhanvien']);
		$this->nhan_vien_id->setDbValue($row['nhan_vien_id']);
		$this->chuc_danh->setDbValue($row['chuc_danh']);
		$this->ngay_sua_chua->setDbValue($row['ngay_sua_chua']);
		$this->thoi_gian->setDbValue($row['thoi_gian']);
		$this->noi_dung->setDbValue($row['noi_dung']);
		$this->Picture->Upload->DbValue = $row['Picture'];
		if (is_array($this->Picture->Upload->DbValue) || is_object($this->Picture->Upload->DbValue)) // Byte array
			$this->Picture->Upload->DbValue = BytesToString($this->Picture->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['sua_chua_id'] = NULL;
		$row['tennhanvien'] = NULL;
		$row['nhan_vien_id'] = NULL;
		$row['chuc_danh'] = NULL;
		$row['ngay_sua_chua'] = NULL;
		$row['thoi_gian'] = NULL;
		$row['noi_dung'] = NULL;
		$row['Picture'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->thoi_gian->FormValue == $this->thoi_gian->CurrentValue && is_numeric(ConvertToFloatString($this->thoi_gian->CurrentValue)))
			$this->thoi_gian->CurrentValue = ConvertToFloatString($this->thoi_gian->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// sua_chua_id
		// tennhanvien
		// nhan_vien_id
		// chuc_danh
		// ngay_sua_chua
		// thoi_gian
		// noi_dung
		// Picture

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewCustomAttributes = "";

			// sua_chua_id
			$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
			$curVal = strval($this->sua_chua_id->CurrentValue);
			if ($curVal != "") {
				$this->sua_chua_id->ViewValue = $this->sua_chua_id->lookupCacheOption($curVal);
				if ($this->sua_chua_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`sua_chua_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sua_chua_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->sua_chua_id->ViewValue = $this->sua_chua_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
					}
				}
			} else {
				$this->sua_chua_id->ViewValue = NULL;
			}
			$this->sua_chua_id->ViewCustomAttributes = "";

			// tennhanvien
			$this->tennhanvien->ViewValue = $this->tennhanvien->CurrentValue;
			$curVal = strval($this->tennhanvien->CurrentValue);
			if ($curVal != "") {
				$this->tennhanvien->ViewValue = $this->tennhanvien->lookupCacheOption($curVal);
				if ($this->tennhanvien->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
					$sqlWrk = $this->tennhanvien->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn("diavatly")->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tennhanvien->ViewValue = $this->tennhanvien->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tennhanvien->ViewValue = $this->tennhanvien->CurrentValue;
					}
				}
			} else {
				$this->tennhanvien->ViewValue = NULL;
			}
			$this->tennhanvien->ViewCustomAttributes = "";

			// nhan_vien_id
			$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->CurrentValue;
			$curVal = strval($this->nhan_vien_id->CurrentValue);
			if ($curVal != "") {
				$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->lookupCacheOption($curVal);
				if ($this->nhan_vien_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
					$sqlWrk = $this->nhan_vien_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn("diavatly")->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nhan_vien_id->ViewValue = $this->nhan_vien_id->CurrentValue;
					}
				}
			} else {
				$this->nhan_vien_id->ViewValue = NULL;
			}
			$this->nhan_vien_id->ViewCustomAttributes = "";

			// chuc_danh
			$this->chuc_danh->ViewValue = $this->chuc_danh->CurrentValue;
			$curVal = strval($this->chuc_danh->CurrentValue);
			if ($curVal != "") {
				$this->chuc_danh->ViewValue = $this->chuc_danh->lookupCacheOption($curVal);
				if ($this->chuc_danh->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
					$sqlWrk = $this->chuc_danh->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn("diavatly")->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->chuc_danh->ViewValue = $this->chuc_danh->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->chuc_danh->ViewValue = $this->chuc_danh->CurrentValue;
					}
				}
			} else {
				$this->chuc_danh->ViewValue = NULL;
			}
			$this->chuc_danh->ViewCustomAttributes = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
			$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 7);
			$this->ngay_sua_chua->ViewCustomAttributes = "";

			// thoi_gian
			$this->thoi_gian->ViewValue = $this->thoi_gian->CurrentValue;
			$this->thoi_gian->ViewValue = FormatNumber($this->thoi_gian->ViewValue, 2, -2, -2, -2);
			$this->thoi_gian->ViewCustomAttributes = "";

			// noi_dung
			$this->noi_dung->ViewValue = $this->noi_dung->CurrentValue;
			$this->noi_dung->ViewCustomAttributes = "";

			// nhan_vien_id
			$this->nhan_vien_id->LinkCustomAttributes = "";
			$this->nhan_vien_id->HrefValue = "";
			$this->nhan_vien_id->TooltipValue = "";

			// chuc_danh
			$this->chuc_danh->LinkCustomAttributes = "";
			$this->chuc_danh->HrefValue = "";
			$this->chuc_danh->TooltipValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->LinkCustomAttributes = "";
			$this->ngay_sua_chua->HrefValue = "";
			$this->ngay_sua_chua->TooltipValue = "";

			// thoi_gian
			$this->thoi_gian->LinkCustomAttributes = "";
			$this->thoi_gian->HrefValue = "";
			$this->thoi_gian->TooltipValue = "";

			// noi_dung
			$this->noi_dung->LinkCustomAttributes = "";
			$this->noi_dung->HrefValue = "";
			$this->noi_dung->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// nhan_vien_id
			$this->nhan_vien_id->EditAttrs["class"] = "form-control";
			$this->nhan_vien_id->EditCustomAttributes = "";
			$this->nhan_vien_id->EditValue = HtmlEncode($this->nhan_vien_id->CurrentValue);
			$curVal = strval($this->nhan_vien_id->CurrentValue);
			if ($curVal != "") {
				$this->nhan_vien_id->EditValue = $this->nhan_vien_id->lookupCacheOption($curVal);
				if ($this->nhan_vien_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
					$sqlWrk = $this->nhan_vien_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn("diavatly")->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->nhan_vien_id->EditValue = $this->nhan_vien_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nhan_vien_id->EditValue = HtmlEncode($this->nhan_vien_id->CurrentValue);
					}
				}
			} else {
				$this->nhan_vien_id->EditValue = NULL;
			}
			$this->nhan_vien_id->PlaceHolder = RemoveHtml($this->nhan_vien_id->caption());

			// chuc_danh
			$this->chuc_danh->EditAttrs["class"] = "form-control";
			$this->chuc_danh->EditCustomAttributes = "";
			$this->chuc_danh->EditValue = $this->chuc_danh->CurrentValue;
			$curVal = strval($this->chuc_danh->CurrentValue);
			if ($curVal != "") {
				$this->chuc_danh->EditValue = $this->chuc_danh->lookupCacheOption($curVal);
				if ($this->chuc_danh->EditValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
					$sqlWrk = $this->chuc_danh->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn("diavatly")->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->chuc_danh->EditValue = $this->chuc_danh->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->chuc_danh->EditValue = $this->chuc_danh->CurrentValue;
					}
				}
			} else {
				$this->chuc_danh->EditValue = NULL;
			}
			$this->chuc_danh->ViewCustomAttributes = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
			$this->ngay_sua_chua->EditCustomAttributes = "";
			$this->ngay_sua_chua->EditValue = HtmlEncode(FormatDateTime($this->ngay_sua_chua->CurrentValue, 7));
			$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

			// thoi_gian
			$this->thoi_gian->EditAttrs["class"] = "form-control";
			$this->thoi_gian->EditCustomAttributes = "";
			$this->thoi_gian->EditValue = HtmlEncode($this->thoi_gian->CurrentValue);
			$this->thoi_gian->PlaceHolder = RemoveHtml($this->thoi_gian->caption());
			if (strval($this->thoi_gian->EditValue) != "" && is_numeric($this->thoi_gian->EditValue))
				$this->thoi_gian->EditValue = FormatNumber($this->thoi_gian->EditValue, -2, -2, -2, -2);
			

			// noi_dung
			$this->noi_dung->EditAttrs["class"] = "form-control";
			$this->noi_dung->EditCustomAttributes = "";
			$this->noi_dung->EditValue = HtmlEncode($this->noi_dung->CurrentValue);
			$this->noi_dung->PlaceHolder = RemoveHtml($this->noi_dung->caption());

			// Edit refer script
			// nhan_vien_id

			$this->nhan_vien_id->LinkCustomAttributes = "";
			$this->nhan_vien_id->HrefValue = "";

			// chuc_danh
			$this->chuc_danh->LinkCustomAttributes = "";
			$this->chuc_danh->HrefValue = "";
			$this->chuc_danh->TooltipValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->LinkCustomAttributes = "";
			$this->ngay_sua_chua->HrefValue = "";

			// thoi_gian
			$this->thoi_gian->LinkCustomAttributes = "";
			$this->thoi_gian->HrefValue = "";

			// noi_dung
			$this->noi_dung->LinkCustomAttributes = "";
			$this->noi_dung->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->nhan_vien_id->Required) {
			if (!$this->nhan_vien_id->IsDetailKey && $this->nhan_vien_id->FormValue != NULL && $this->nhan_vien_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nhan_vien_id->caption(), $this->nhan_vien_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->nhan_vien_id->FormValue)) {
			AddMessage($FormError, $this->nhan_vien_id->errorMessage());
		}
		if ($this->chuc_danh->Required) {
			if (!$this->chuc_danh->IsDetailKey && $this->chuc_danh->FormValue != NULL && $this->chuc_danh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->chuc_danh->caption(), $this->chuc_danh->RequiredErrorMessage));
			}
		}
		if ($this->ngay_sua_chua->Required) {
			if (!$this->ngay_sua_chua->IsDetailKey && $this->ngay_sua_chua->FormValue != NULL && $this->ngay_sua_chua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_sua_chua->caption(), $this->ngay_sua_chua->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->ngay_sua_chua->FormValue)) {
			AddMessage($FormError, $this->ngay_sua_chua->errorMessage());
		}
		if ($this->thoi_gian->Required) {
			if (!$this->thoi_gian->IsDetailKey && $this->thoi_gian->FormValue != NULL && $this->thoi_gian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->thoi_gian->caption(), $this->thoi_gian->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->thoi_gian->FormValue)) {
			AddMessage($FormError, $this->thoi_gian->errorMessage());
		}
		if ($this->noi_dung->Required) {
			if (!$this->noi_dung->IsDetailKey && $this->noi_dung->FormValue != NULL && $this->noi_dung->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->noi_dung->caption(), $this->noi_dung->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// nhan_vien_id
			$this->nhan_vien_id->setDbValueDef($rsnew, $this->nhan_vien_id->CurrentValue, 0, $this->nhan_vien_id->ReadOnly);

			// ngay_sua_chua
			$this->ngay_sua_chua->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 7), NULL, $this->ngay_sua_chua->ReadOnly);

			// thoi_gian
			$this->thoi_gian->setDbValueDef($rsnew, $this->thoi_gian->CurrentValue, NULL, $this->thoi_gian->ReadOnly);

			// noi_dung
			$this->noi_dung->setDbValueDef($rsnew, $this->noi_dung->CurrentValue, NULL, $this->noi_dung->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "ck_danhmuc_suachua") {
				$validMaster = TRUE;
				if (($parm = Get("fk_sua_chua_id", Get("sua_chua_id"))) !== NULL) {
					$GLOBALS["ck_danhmuc_suachua"]->sua_chua_id->setQueryStringValue($parm);
					$this->sua_chua_id->setQueryStringValue($GLOBALS["ck_danhmuc_suachua"]->sua_chua_id->QueryStringValue);
					$this->sua_chua_id->setSessionValue($this->sua_chua_id->QueryStringValue);
					if (!is_numeric($GLOBALS["ck_danhmuc_suachua"]->sua_chua_id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "ck_danhmuc_suachua") {
				$validMaster = TRUE;
				if (($parm = Post("fk_sua_chua_id", Post("sua_chua_id"))) !== NULL) {
					$GLOBALS["ck_danhmuc_suachua"]->sua_chua_id->setFormValue($parm);
					$this->sua_chua_id->setFormValue($GLOBALS["ck_danhmuc_suachua"]->sua_chua_id->FormValue);
					$this->sua_chua_id->setSessionValue($this->sua_chua_id->FormValue);
					if (!is_numeric($GLOBALS["ck_danhmuc_suachua"]->sua_chua_id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "ck_danhmuc_suachua") {
				if ($this->sua_chua_id->CurrentValue == "")
					$this->sua_chua_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ck_chitiet_suachualist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_sua_chua_id":
					break;
				case "x_tennhanvien":
					$conn = Conn("diavatly");
					break;
				case "x_nhan_vien_id":
					$conn = Conn("diavatly");
					break;
				case "x_chuc_danh":
					$conn = Conn("diavatly");
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_sua_chua_id":
							break;
						case "x_tennhanvien":
							break;
						case "x_nhan_vien_id":
							break;
						case "x_chuc_danh":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>