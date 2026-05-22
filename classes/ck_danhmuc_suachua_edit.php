<?php
namespace PHPMaker2020\projectCoKhi;

/**
 * Page class
 */
class ck_danhmuc_suachua_edit extends ck_danhmuc_suachua
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5DCEF576-624A-4686-A415-DE69CC04A397}";

	// Table name
	public $TableName = 'ck_danhmuc_suachua';

	// Page object name
	public $PageObjName = "ck_danhmuc_suachua_edit";

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

		// Table object (ck_danhmuc_suachua)
		if (!isset($GLOBALS["ck_danhmuc_suachua"]) || get_class($GLOBALS["ck_danhmuc_suachua"]) == PROJECT_NAMESPACE . "ck_danhmuc_suachua") {
			$GLOBALS["ck_danhmuc_suachua"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["ck_danhmuc_suachua"];
		}

		// Table object (nhan_vien)
		if (!isset($GLOBALS['nhan_vien']))
			$GLOBALS['nhan_vien'] = new nhan_vien();

		// Table object (ck_don_hang)
		if (!isset($GLOBALS['ck_don_hang']))
			$GLOBALS['ck_don_hang'] = new ck_don_hang();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'ck_danhmuc_suachua');

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
		global $ck_danhmuc_suachua;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($ck_danhmuc_suachua);
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
					if ($pageName == "ck_danhmuc_suachuaview.php")
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
			$key .= @$ar['sua_chua_id'];
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
			$this->sua_chua_id->Visible = FALSE;
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
					$this->terminate(GetUrl("ck_danhmuc_suachualist.php"));
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
		$this->sua_chua_id->setVisibility();
		$this->chuanloai_id->setVisibility();
		$this->thiet_bi_id->setVisibility();
		$this->ngay_sua_chua->setVisibility();
		$this->noi_dung_sua_chua->setVisibility();
		$this->thoi_gian_sua_chua->setVisibility();
		$this->nguoi_nhap_lieu->setVisibility();
		$this->dich_vu->setVisibility();
		$this->hoan_thanh->setVisibility();
		$this->ghi_chu->setVisibility();
		$this->id_don_hang->setVisibility();
		$this->ngay_hoan_thanh->setVisibility();
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
		$this->setupLookupOptions($this->chuanloai_id);
		$this->setupLookupOptions($this->thiet_bi_id);
		$this->setupLookupOptions($this->nguoi_nhap_lieu);
		$this->setupLookupOptions($this->id_don_hang);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("ck_danhmuc_suachualist.php");
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
			if (Get("sua_chua_id") !== NULL) {
				$this->sua_chua_id->setQueryStringValue(Get("sua_chua_id"));
				$this->sua_chua_id->setOldValue($this->sua_chua_id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->sua_chua_id->setQueryStringValue(Key(0));
				$this->sua_chua_id->setOldValue($this->sua_chua_id->QueryStringValue);
			} elseif (Post("sua_chua_id") !== NULL) {
				$this->sua_chua_id->setFormValue(Post("sua_chua_id"));
				$this->sua_chua_id->setOldValue($this->sua_chua_id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->sua_chua_id->setQueryStringValue(Route(2));
				$this->sua_chua_id->setOldValue($this->sua_chua_id->QueryStringValue);
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
				if ($CurrentForm->hasValue("x_sua_chua_id")) {
					$this->sua_chua_id->setFormValue($CurrentForm->getValue("x_sua_chua_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("sua_chua_id") !== NULL) {
					$this->sua_chua_id->setQueryStringValue(Get("sua_chua_id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->sua_chua_id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->sua_chua_id->CurrentValue = NULL;
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

			// Set up detail parameters
			$this->setupDetailParms();
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
					$this->terminate("ck_danhmuc_suachualist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "update": // Update
				$returnUrl = "ck_danhmuc_suachualist.php";
				if (GetPageName($returnUrl) == "ck_danhmuc_suachualist.php")
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

					// Set up detail parameters
					$this->setupDetailParms();
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

		// Check field name 'sua_chua_id' first before field var 'x_sua_chua_id'
		$val = $CurrentForm->hasValue("sua_chua_id") ? $CurrentForm->getValue("sua_chua_id") : $CurrentForm->getValue("x_sua_chua_id");
		if (!$this->sua_chua_id->IsDetailKey)
			$this->sua_chua_id->setFormValue($val);

		// Check field name 'chuanloai_id' first before field var 'x_chuanloai_id'
		$val = $CurrentForm->hasValue("chuanloai_id") ? $CurrentForm->getValue("chuanloai_id") : $CurrentForm->getValue("x_chuanloai_id");
		if (!$this->chuanloai_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->chuanloai_id->Visible = FALSE; // Disable update for API request
			else
				$this->chuanloai_id->setFormValue($val);
		}

		// Check field name 'thiet_bi_id' first before field var 'x_thiet_bi_id'
		$val = $CurrentForm->hasValue("thiet_bi_id") ? $CurrentForm->getValue("thiet_bi_id") : $CurrentForm->getValue("x_thiet_bi_id");
		if (!$this->thiet_bi_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->thiet_bi_id->Visible = FALSE; // Disable update for API request
			else
				$this->thiet_bi_id->setFormValue($val);
		}

		// Check field name 'ngay_sua_chua' first before field var 'x_ngay_sua_chua'
		$val = $CurrentForm->hasValue("ngay_sua_chua") ? $CurrentForm->getValue("ngay_sua_chua") : $CurrentForm->getValue("x_ngay_sua_chua");
		if (!$this->ngay_sua_chua->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ngay_sua_chua->Visible = FALSE; // Disable update for API request
			else
				$this->ngay_sua_chua->setFormValue($val);
			$this->ngay_sua_chua->CurrentValue = UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 14);
		}

		// Check field name 'noi_dung_sua_chua' first before field var 'x_noi_dung_sua_chua'
		$val = $CurrentForm->hasValue("noi_dung_sua_chua") ? $CurrentForm->getValue("noi_dung_sua_chua") : $CurrentForm->getValue("x_noi_dung_sua_chua");
		if (!$this->noi_dung_sua_chua->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->noi_dung_sua_chua->Visible = FALSE; // Disable update for API request
			else
				$this->noi_dung_sua_chua->setFormValue($val);
		}

		// Check field name 'thoi_gian_sua_chua' first before field var 'x_thoi_gian_sua_chua'
		$val = $CurrentForm->hasValue("thoi_gian_sua_chua") ? $CurrentForm->getValue("thoi_gian_sua_chua") : $CurrentForm->getValue("x_thoi_gian_sua_chua");
		if (!$this->thoi_gian_sua_chua->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->thoi_gian_sua_chua->Visible = FALSE; // Disable update for API request
			else
				$this->thoi_gian_sua_chua->setFormValue($val);
		}

		// Check field name 'nguoi_nhap_lieu' first before field var 'x_nguoi_nhap_lieu'
		$val = $CurrentForm->hasValue("nguoi_nhap_lieu") ? $CurrentForm->getValue("nguoi_nhap_lieu") : $CurrentForm->getValue("x_nguoi_nhap_lieu");
		if (!$this->nguoi_nhap_lieu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nguoi_nhap_lieu->Visible = FALSE; // Disable update for API request
			else
				$this->nguoi_nhap_lieu->setFormValue($val);
		}

		// Check field name 'dich_vu' first before field var 'x_dich_vu'
		$val = $CurrentForm->hasValue("dich_vu") ? $CurrentForm->getValue("dich_vu") : $CurrentForm->getValue("x_dich_vu");
		if (!$this->dich_vu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->dich_vu->Visible = FALSE; // Disable update for API request
			else
				$this->dich_vu->setFormValue($val);
		}

		// Check field name 'hoan_thanh' first before field var 'x_hoan_thanh'
		$val = $CurrentForm->hasValue("hoan_thanh") ? $CurrentForm->getValue("hoan_thanh") : $CurrentForm->getValue("x_hoan_thanh");
		if (!$this->hoan_thanh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hoan_thanh->Visible = FALSE; // Disable update for API request
			else
				$this->hoan_thanh->setFormValue($val);
		}

		// Check field name 'ghi_chu' first before field var 'x_ghi_chu'
		$val = $CurrentForm->hasValue("ghi_chu") ? $CurrentForm->getValue("ghi_chu") : $CurrentForm->getValue("x_ghi_chu");
		if (!$this->ghi_chu->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ghi_chu->Visible = FALSE; // Disable update for API request
			else
				$this->ghi_chu->setFormValue($val);
		}

		// Check field name 'id_don_hang' first before field var 'x_id_don_hang'
		$val = $CurrentForm->hasValue("id_don_hang") ? $CurrentForm->getValue("id_don_hang") : $CurrentForm->getValue("x_id_don_hang");
		if (!$this->id_don_hang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_don_hang->Visible = FALSE; // Disable update for API request
			else
				$this->id_don_hang->setFormValue($val);
		}

		// Check field name 'ngay_hoan_thanh' first before field var 'x_ngay_hoan_thanh'
		$val = $CurrentForm->hasValue("ngay_hoan_thanh") ? $CurrentForm->getValue("ngay_hoan_thanh") : $CurrentForm->getValue("x_ngay_hoan_thanh");
		if (!$this->ngay_hoan_thanh->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ngay_hoan_thanh->Visible = FALSE; // Disable update for API request
			else
				$this->ngay_hoan_thanh->setFormValue($val);
			$this->ngay_hoan_thanh->CurrentValue = UnFormatDateTime($this->ngay_hoan_thanh->CurrentValue, 7);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->sua_chua_id->CurrentValue = $this->sua_chua_id->FormValue;
		$this->chuanloai_id->CurrentValue = $this->chuanloai_id->FormValue;
		$this->thiet_bi_id->CurrentValue = $this->thiet_bi_id->FormValue;
		$this->ngay_sua_chua->CurrentValue = $this->ngay_sua_chua->FormValue;
		$this->ngay_sua_chua->CurrentValue = UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 14);
		$this->noi_dung_sua_chua->CurrentValue = $this->noi_dung_sua_chua->FormValue;
		$this->thoi_gian_sua_chua->CurrentValue = $this->thoi_gian_sua_chua->FormValue;
		$this->nguoi_nhap_lieu->CurrentValue = $this->nguoi_nhap_lieu->FormValue;
		$this->dich_vu->CurrentValue = $this->dich_vu->FormValue;
		$this->hoan_thanh->CurrentValue = $this->hoan_thanh->FormValue;
		$this->ghi_chu->CurrentValue = $this->ghi_chu->FormValue;
		$this->id_don_hang->CurrentValue = $this->id_don_hang->FormValue;
		$this->ngay_hoan_thanh->CurrentValue = $this->ngay_hoan_thanh->FormValue;
		$this->ngay_hoan_thanh->CurrentValue = UnFormatDateTime($this->ngay_hoan_thanh->CurrentValue, 7);
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
		$this->sua_chua_id->setDbValue($row['sua_chua_id']);
		$this->chuanloai_id->setDbValue($row['chuanloai_id']);
		$this->thiet_bi_id->setDbValue($row['thiet_bi_id']);
		$this->ngay_sua_chua->setDbValue($row['ngay_sua_chua']);
		$this->noi_dung_sua_chua->setDbValue($row['noi_dung_sua_chua']);
		$this->thoi_gian_sua_chua->setDbValue($row['thoi_gian_sua_chua']);
		$this->nguoi_nhap_lieu->setDbValue($row['nguoi_nhap_lieu']);
		$this->dich_vu->setDbValue($row['dich_vu']);
		$this->hoan_thanh->setDbValue($row['hoan_thanh']);
		$this->ghi_chu->setDbValue($row['ghi_chu']);
		$this->id_don_hang->setDbValue($row['id_don_hang']);
		if (array_key_exists('EV__id_don_hang', $rs->fields)) {
			$this->id_don_hang->VirtualValue = $rs->fields('EV__id_don_hang'); // Set up virtual field value
		} else {
			$this->id_don_hang->VirtualValue = ""; // Clear value
		}
		$this->ngay_hoan_thanh->setDbValue($row['ngay_hoan_thanh']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['sua_chua_id'] = NULL;
		$row['chuanloai_id'] = NULL;
		$row['thiet_bi_id'] = NULL;
		$row['ngay_sua_chua'] = NULL;
		$row['noi_dung_sua_chua'] = NULL;
		$row['thoi_gian_sua_chua'] = NULL;
		$row['nguoi_nhap_lieu'] = NULL;
		$row['dich_vu'] = NULL;
		$row['hoan_thanh'] = NULL;
		$row['ghi_chu'] = NULL;
		$row['id_don_hang'] = NULL;
		$row['ngay_hoan_thanh'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("sua_chua_id")) != "")
			$this->sua_chua_id->OldValue = $this->getKey("sua_chua_id"); // sua_chua_id
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

		if ($this->thoi_gian_sua_chua->FormValue == $this->thoi_gian_sua_chua->CurrentValue && is_numeric(ConvertToFloatString($this->thoi_gian_sua_chua->CurrentValue)))
			$this->thoi_gian_sua_chua->CurrentValue = ConvertToFloatString($this->thoi_gian_sua_chua->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// sua_chua_id
		// chuanloai_id
		// thiet_bi_id
		// ngay_sua_chua
		// noi_dung_sua_chua
		// thoi_gian_sua_chua
		// nguoi_nhap_lieu
		// dich_vu
		// hoan_thanh
		// ghi_chu
		// id_don_hang
		// ngay_hoan_thanh

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// sua_chua_id
			$this->sua_chua_id->ViewValue = $this->sua_chua_id->CurrentValue;
			$this->sua_chua_id->ViewCustomAttributes = "";

			// chuanloai_id
			$curVal = strval($this->chuanloai_id->CurrentValue);
			if ($curVal != "") {
				$this->chuanloai_id->ViewValue = $this->chuanloai_id->lookupCacheOption($curVal);
				if ($this->chuanloai_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`chungloai_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->chuanloai_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->chuanloai_id->ViewValue = $this->chuanloai_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->chuanloai_id->ViewValue = $this->chuanloai_id->CurrentValue;
					}
				}
			} else {
				$this->chuanloai_id->ViewValue = NULL;
			}
			$this->chuanloai_id->ViewCustomAttributes = "";

			// thiet_bi_id
			$curVal = strval($this->thiet_bi_id->CurrentValue);
			if ($curVal != "") {
				$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->lookupCacheOption($curVal);
				if ($this->thiet_bi_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`thiet_bi_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->thiet_bi_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->CurrentValue;
					}
				}
			} else {
				$this->thiet_bi_id->ViewValue = NULL;
			}
			$this->thiet_bi_id->ViewCustomAttributes = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->ViewValue = $this->ngay_sua_chua->CurrentValue;
			$this->ngay_sua_chua->ViewValue = FormatDateTime($this->ngay_sua_chua->ViewValue, 14);
			$this->ngay_sua_chua->ViewCustomAttributes = "";

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->ViewValue = $this->noi_dung_sua_chua->CurrentValue;
			$this->noi_dung_sua_chua->ViewCustomAttributes = "";

			// thoi_gian_sua_chua
			$this->thoi_gian_sua_chua->ViewValue = $this->thoi_gian_sua_chua->CurrentValue;
			$this->thoi_gian_sua_chua->ViewValue = FormatNumber($this->thoi_gian_sua_chua->ViewValue, 2, -2, -2, -2);
			$this->thoi_gian_sua_chua->ViewCustomAttributes = "";

			// nguoi_nhap_lieu
			$curVal = strval($this->nguoi_nhap_lieu->CurrentValue);
			if ($curVal != "") {
				$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->lookupCacheOption($curVal);
				if ($this->nguoi_nhap_lieu->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "diavatly");
					$lookupFilter = function() {
						return "`bo_phan_id`=18";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					$sqlWrk = $this->nguoi_nhap_lieu->Lookup->getSql(FALSE, $filterWrk, $lookupFilter, $this);
					$rswrk = Conn("diavatly")->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->CurrentValue;
					}
				}
			} else {
				$this->nguoi_nhap_lieu->ViewValue = NULL;
			}
			$this->nguoi_nhap_lieu->ViewCustomAttributes = "";

			// dich_vu
			if (ConvertToBool($this->dich_vu->CurrentValue)) {
				$this->dich_vu->ViewValue = $this->dich_vu->tagCaption(1) != "" ? $this->dich_vu->tagCaption(1) : "Yes";
			} else {
				$this->dich_vu->ViewValue = $this->dich_vu->tagCaption(2) != "" ? $this->dich_vu->tagCaption(2) : "No";
			}
			$this->dich_vu->ViewCustomAttributes = "";

			// hoan_thanh
			if (ConvertToBool($this->hoan_thanh->CurrentValue)) {
				$this->hoan_thanh->ViewValue = $this->hoan_thanh->tagCaption(1) != "" ? $this->hoan_thanh->tagCaption(1) : "Yes";
			} else {
				$this->hoan_thanh->ViewValue = $this->hoan_thanh->tagCaption(2) != "" ? $this->hoan_thanh->tagCaption(2) : "No";
			}
			$this->hoan_thanh->ViewCustomAttributes = "";

			// ghi_chu
			$this->ghi_chu->ViewValue = $this->ghi_chu->CurrentValue;
			$this->ghi_chu->ViewCustomAttributes = "";

			// id_don_hang
			if ($this->id_don_hang->VirtualValue != "") {
				$this->id_don_hang->ViewValue = $this->id_don_hang->VirtualValue;
			} else {
				$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
				$curVal = strval($this->id_don_hang->CurrentValue);
				if ($curVal != "") {
					$this->id_don_hang->ViewValue = $this->id_don_hang->lookupCacheOption($curVal);
					if ($this->id_don_hang->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->id_don_hang->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->id_don_hang->ViewValue = $this->id_don_hang->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
						}
					}
				} else {
					$this->id_don_hang->ViewValue = NULL;
				}
			}
			$this->id_don_hang->ViewCustomAttributes = "";

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->ViewValue = $this->ngay_hoan_thanh->CurrentValue;
			$this->ngay_hoan_thanh->ViewValue = FormatDateTime($this->ngay_hoan_thanh->ViewValue, 7);
			$this->ngay_hoan_thanh->ViewCustomAttributes = "";

			// sua_chua_id
			$this->sua_chua_id->LinkCustomAttributes = "";
			$this->sua_chua_id->HrefValue = "";
			$this->sua_chua_id->TooltipValue = "";

			// chuanloai_id
			$this->chuanloai_id->LinkCustomAttributes = "";
			$this->chuanloai_id->HrefValue = "";
			$this->chuanloai_id->TooltipValue = "";

			// thiet_bi_id
			$this->thiet_bi_id->LinkCustomAttributes = "";
			$this->thiet_bi_id->HrefValue = "";
			$this->thiet_bi_id->TooltipValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->LinkCustomAttributes = "";
			$this->ngay_sua_chua->HrefValue = "";
			$this->ngay_sua_chua->TooltipValue = "";

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->LinkCustomAttributes = "";
			$this->noi_dung_sua_chua->HrefValue = "";
			$this->noi_dung_sua_chua->TooltipValue = "";

			// thoi_gian_sua_chua
			$this->thoi_gian_sua_chua->LinkCustomAttributes = "";
			$this->thoi_gian_sua_chua->HrefValue = "";
			$this->thoi_gian_sua_chua->TooltipValue = "";

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->LinkCustomAttributes = "";
			$this->nguoi_nhap_lieu->HrefValue = "";
			$this->nguoi_nhap_lieu->TooltipValue = "";

			// dich_vu
			$this->dich_vu->LinkCustomAttributes = "";
			$this->dich_vu->HrefValue = "";
			$this->dich_vu->TooltipValue = "";

			// hoan_thanh
			$this->hoan_thanh->LinkCustomAttributes = "";
			$this->hoan_thanh->HrefValue = "";
			$this->hoan_thanh->TooltipValue = "";

			// ghi_chu
			$this->ghi_chu->LinkCustomAttributes = "";
			$this->ghi_chu->HrefValue = "";
			$this->ghi_chu->TooltipValue = "";

			// id_don_hang
			$this->id_don_hang->LinkCustomAttributes = "";
			$this->id_don_hang->HrefValue = "";
			$this->id_don_hang->TooltipValue = "";

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->LinkCustomAttributes = "";
			$this->ngay_hoan_thanh->HrefValue = "";
			$this->ngay_hoan_thanh->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// sua_chua_id
			$this->sua_chua_id->EditAttrs["class"] = "form-control";
			$this->sua_chua_id->EditCustomAttributes = "";
			$this->sua_chua_id->EditValue = $this->sua_chua_id->CurrentValue;
			$this->sua_chua_id->ViewCustomAttributes = "";

			// chuanloai_id
			$this->chuanloai_id->EditAttrs["class"] = "form-control";
			$this->chuanloai_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->chuanloai_id->CurrentValue));
			if ($curVal != "")
				$this->chuanloai_id->ViewValue = $this->chuanloai_id->lookupCacheOption($curVal);
			else
				$this->chuanloai_id->ViewValue = $this->chuanloai_id->Lookup !== NULL && is_array($this->chuanloai_id->Lookup->Options) ? $curVal : NULL;
			if ($this->chuanloai_id->ViewValue !== NULL) { // Load from cache
				$this->chuanloai_id->EditValue = array_values($this->chuanloai_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`chungloai_id`" . SearchString("=", $this->chuanloai_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->chuanloai_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->chuanloai_id->EditValue = $arwrk;
			}

			// thiet_bi_id
			$this->thiet_bi_id->EditAttrs["class"] = "form-control";
			$this->thiet_bi_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->thiet_bi_id->CurrentValue));
			if ($curVal != "")
				$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->lookupCacheOption($curVal);
			else
				$this->thiet_bi_id->ViewValue = $this->thiet_bi_id->Lookup !== NULL && is_array($this->thiet_bi_id->Lookup->Options) ? $curVal : NULL;
			if ($this->thiet_bi_id->ViewValue !== NULL) { // Load from cache
				$this->thiet_bi_id->EditValue = array_values($this->thiet_bi_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`thiet_bi_id`" . SearchString("=", $this->thiet_bi_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->thiet_bi_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->thiet_bi_id->EditValue = $arwrk;
			}

			// ngay_sua_chua
			$this->ngay_sua_chua->EditAttrs["class"] = "form-control";
			$this->ngay_sua_chua->EditCustomAttributes = "";
			$this->ngay_sua_chua->EditValue = HtmlEncode(FormatDateTime($this->ngay_sua_chua->CurrentValue, 14));
			$this->ngay_sua_chua->PlaceHolder = RemoveHtml($this->ngay_sua_chua->caption());

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->EditAttrs["class"] = "form-control";
			$this->noi_dung_sua_chua->EditCustomAttributes = "";
			$this->noi_dung_sua_chua->EditValue = HtmlEncode($this->noi_dung_sua_chua->CurrentValue);
			$this->noi_dung_sua_chua->PlaceHolder = RemoveHtml($this->noi_dung_sua_chua->caption());

			// thoi_gian_sua_chua
			$this->thoi_gian_sua_chua->EditAttrs["class"] = "form-control";
			$this->thoi_gian_sua_chua->EditCustomAttributes = "";
			$this->thoi_gian_sua_chua->EditValue = HtmlEncode($this->thoi_gian_sua_chua->CurrentValue);
			$this->thoi_gian_sua_chua->PlaceHolder = RemoveHtml($this->thoi_gian_sua_chua->caption());
			if (strval($this->thoi_gian_sua_chua->EditValue) != "" && is_numeric($this->thoi_gian_sua_chua->EditValue))
				$this->thoi_gian_sua_chua->EditValue = FormatNumber($this->thoi_gian_sua_chua->EditValue, -2, -2, -2, -2);
			

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->EditAttrs["class"] = "form-control";
			$this->nguoi_nhap_lieu->EditCustomAttributes = "";
			$curVal = trim(strval($this->nguoi_nhap_lieu->CurrentValue));
			if ($curVal != "")
				$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->lookupCacheOption($curVal);
			else
				$this->nguoi_nhap_lieu->ViewValue = $this->nguoi_nhap_lieu->Lookup !== NULL && is_array($this->nguoi_nhap_lieu->Lookup->Options) ? $curVal : NULL;
			if ($this->nguoi_nhap_lieu->ViewValue !== NULL) { // Load from cache
				$this->nguoi_nhap_lieu->EditValue = array_values($this->nguoi_nhap_lieu->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nhan_vien_id`" . SearchString("=", $this->nguoi_nhap_lieu->CurrentValue, DATATYPE_NUMBER, "diavatly");
				}
				$lookupFilter = function() {
					return "`bo_phan_id`=18";
				};
				$lookupFilter = $lookupFilter->bindTo($this);
				$sqlWrk = $this->nguoi_nhap_lieu->Lookup->getSql(TRUE, $filterWrk, $lookupFilter, $this);
				$rswrk = Conn("diavatly")->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->nguoi_nhap_lieu->EditValue = $arwrk;
			}

			// dich_vu
			$this->dich_vu->EditCustomAttributes = "";
			$this->dich_vu->EditValue = $this->dich_vu->options(FALSE);

			// hoan_thanh
			$this->hoan_thanh->EditCustomAttributes = "";
			$this->hoan_thanh->EditValue = $this->hoan_thanh->options(FALSE);

			// ghi_chu
			$this->ghi_chu->EditAttrs["class"] = "form-control";
			$this->ghi_chu->EditCustomAttributes = "";
			$this->ghi_chu->EditValue = HtmlEncode($this->ghi_chu->CurrentValue);
			$this->ghi_chu->PlaceHolder = RemoveHtml($this->ghi_chu->caption());

			// id_don_hang
			$this->id_don_hang->EditAttrs["class"] = "form-control";
			$this->id_don_hang->EditCustomAttributes = "";
			if ($this->id_don_hang->getSessionValue() != "") {
				$this->id_don_hang->CurrentValue = $this->id_don_hang->getSessionValue();
				if ($this->id_don_hang->VirtualValue != "") {
					$this->id_don_hang->ViewValue = $this->id_don_hang->VirtualValue;
				} else {
					$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
					$curVal = strval($this->id_don_hang->CurrentValue);
					if ($curVal != "") {
						$this->id_don_hang->ViewValue = $this->id_don_hang->lookupCacheOption($curVal);
						if ($this->id_don_hang->ViewValue === NULL) { // Lookup from database
							$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
							$sqlWrk = $this->id_don_hang->Lookup->getSql(FALSE, $filterWrk, '', $this);
							$rswrk = Conn()->execute($sqlWrk);
							if ($rswrk && !$rswrk->EOF) { // Lookup values found
								$arwrk = [];
								$arwrk[1] = $rswrk->fields('df');
								$this->id_don_hang->ViewValue = $this->id_don_hang->displayValue($arwrk);
								$rswrk->Close();
							} else {
								$this->id_don_hang->ViewValue = $this->id_don_hang->CurrentValue;
							}
						}
					} else {
						$this->id_don_hang->ViewValue = NULL;
					}
				}
				$this->id_don_hang->ViewCustomAttributes = "";
			} else {
				$this->id_don_hang->EditValue = HtmlEncode($this->id_don_hang->CurrentValue);
				$this->id_don_hang->PlaceHolder = RemoveHtml($this->id_don_hang->caption());
			}

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->EditAttrs["class"] = "form-control";
			$this->ngay_hoan_thanh->EditCustomAttributes = "";
			$this->ngay_hoan_thanh->EditValue = HtmlEncode(FormatDateTime($this->ngay_hoan_thanh->CurrentValue, 7));
			$this->ngay_hoan_thanh->PlaceHolder = RemoveHtml($this->ngay_hoan_thanh->caption());

			// Edit refer script
			// sua_chua_id

			$this->sua_chua_id->LinkCustomAttributes = "";
			$this->sua_chua_id->HrefValue = "";

			// chuanloai_id
			$this->chuanloai_id->LinkCustomAttributes = "";
			$this->chuanloai_id->HrefValue = "";

			// thiet_bi_id
			$this->thiet_bi_id->LinkCustomAttributes = "";
			$this->thiet_bi_id->HrefValue = "";

			// ngay_sua_chua
			$this->ngay_sua_chua->LinkCustomAttributes = "";
			$this->ngay_sua_chua->HrefValue = "";

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->LinkCustomAttributes = "";
			$this->noi_dung_sua_chua->HrefValue = "";

			// thoi_gian_sua_chua
			$this->thoi_gian_sua_chua->LinkCustomAttributes = "";
			$this->thoi_gian_sua_chua->HrefValue = "";

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->LinkCustomAttributes = "";
			$this->nguoi_nhap_lieu->HrefValue = "";

			// dich_vu
			$this->dich_vu->LinkCustomAttributes = "";
			$this->dich_vu->HrefValue = "";

			// hoan_thanh
			$this->hoan_thanh->LinkCustomAttributes = "";
			$this->hoan_thanh->HrefValue = "";

			// ghi_chu
			$this->ghi_chu->LinkCustomAttributes = "";
			$this->ghi_chu->HrefValue = "";

			// id_don_hang
			$this->id_don_hang->LinkCustomAttributes = "";
			$this->id_don_hang->HrefValue = "";

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->LinkCustomAttributes = "";
			$this->ngay_hoan_thanh->HrefValue = "";
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
		if ($this->sua_chua_id->Required) {
			if (!$this->sua_chua_id->IsDetailKey && $this->sua_chua_id->FormValue != NULL && $this->sua_chua_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sua_chua_id->caption(), $this->sua_chua_id->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->sua_chua_id->FormValue)) {
			AddMessage($FormError, $this->sua_chua_id->errorMessage());
		}
		if ($this->chuanloai_id->Required) {
			if (!$this->chuanloai_id->IsDetailKey && $this->chuanloai_id->FormValue != NULL && $this->chuanloai_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->chuanloai_id->caption(), $this->chuanloai_id->RequiredErrorMessage));
			}
		}
		if ($this->thiet_bi_id->Required) {
			if (!$this->thiet_bi_id->IsDetailKey && $this->thiet_bi_id->FormValue != NULL && $this->thiet_bi_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->thiet_bi_id->caption(), $this->thiet_bi_id->RequiredErrorMessage));
			}
		}
		if ($this->ngay_sua_chua->Required) {
			if (!$this->ngay_sua_chua->IsDetailKey && $this->ngay_sua_chua->FormValue != NULL && $this->ngay_sua_chua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_sua_chua->caption(), $this->ngay_sua_chua->RequiredErrorMessage));
			}
		}
		if (!CheckShortEuroDate($this->ngay_sua_chua->FormValue)) {
			AddMessage($FormError, $this->ngay_sua_chua->errorMessage());
		}
		if ($this->noi_dung_sua_chua->Required) {
			if (!$this->noi_dung_sua_chua->IsDetailKey && $this->noi_dung_sua_chua->FormValue != NULL && $this->noi_dung_sua_chua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->noi_dung_sua_chua->caption(), $this->noi_dung_sua_chua->RequiredErrorMessage));
			}
		}
		if ($this->thoi_gian_sua_chua->Required) {
			if (!$this->thoi_gian_sua_chua->IsDetailKey && $this->thoi_gian_sua_chua->FormValue != NULL && $this->thoi_gian_sua_chua->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->thoi_gian_sua_chua->caption(), $this->thoi_gian_sua_chua->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->thoi_gian_sua_chua->FormValue)) {
			AddMessage($FormError, $this->thoi_gian_sua_chua->errorMessage());
		}
		if ($this->nguoi_nhap_lieu->Required) {
			if (!$this->nguoi_nhap_lieu->IsDetailKey && $this->nguoi_nhap_lieu->FormValue != NULL && $this->nguoi_nhap_lieu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nguoi_nhap_lieu->caption(), $this->nguoi_nhap_lieu->RequiredErrorMessage));
			}
		}
		if ($this->dich_vu->Required) {
			if ($this->dich_vu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->dich_vu->caption(), $this->dich_vu->RequiredErrorMessage));
			}
		}
		if ($this->hoan_thanh->Required) {
			if ($this->hoan_thanh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hoan_thanh->caption(), $this->hoan_thanh->RequiredErrorMessage));
			}
		}
		if ($this->ghi_chu->Required) {
			if (!$this->ghi_chu->IsDetailKey && $this->ghi_chu->FormValue != NULL && $this->ghi_chu->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ghi_chu->caption(), $this->ghi_chu->RequiredErrorMessage));
			}
		}
		if ($this->id_don_hang->Required) {
			if (!$this->id_don_hang->IsDetailKey && $this->id_don_hang->FormValue != NULL && $this->id_don_hang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_don_hang->caption(), $this->id_don_hang->RequiredErrorMessage));
			}
		}
		if ($this->ngay_hoan_thanh->Required) {
			if (!$this->ngay_hoan_thanh->IsDetailKey && $this->ngay_hoan_thanh->FormValue != NULL && $this->ngay_hoan_thanh->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ngay_hoan_thanh->caption(), $this->ngay_hoan_thanh->RequiredErrorMessage));
			}
		}
		if (!CheckEuroDate($this->ngay_hoan_thanh->FormValue)) {
			AddMessage($FormError, $this->ngay_hoan_thanh->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("ck_chitiet_suachua", $detailTblVar) && $GLOBALS["ck_chitiet_suachua"]->DetailEdit) {
			if (!isset($GLOBALS["ck_chitiet_suachua_grid"]))
				$GLOBALS["ck_chitiet_suachua_grid"] = new ck_chitiet_suachua_grid(); // Get detail page object
			$GLOBALS["ck_chitiet_suachua_grid"]->validateGridForm();
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

			// Begin transaction
			if ($this->getCurrentDetailTable() != "")
				$conn->beginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// chuanloai_id
			$this->chuanloai_id->setDbValueDef($rsnew, $this->chuanloai_id->CurrentValue, NULL, $this->chuanloai_id->ReadOnly);

			// thiet_bi_id
			$this->thiet_bi_id->setDbValueDef($rsnew, $this->thiet_bi_id->CurrentValue, 0, $this->thiet_bi_id->ReadOnly);

			// ngay_sua_chua
			$this->ngay_sua_chua->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_sua_chua->CurrentValue, 14), CurrentDate(), $this->ngay_sua_chua->ReadOnly);

			// noi_dung_sua_chua
			$this->noi_dung_sua_chua->setDbValueDef($rsnew, $this->noi_dung_sua_chua->CurrentValue, "", $this->noi_dung_sua_chua->ReadOnly);

			// thoi_gian_sua_chua
			$this->thoi_gian_sua_chua->setDbValueDef($rsnew, $this->thoi_gian_sua_chua->CurrentValue, NULL, $this->thoi_gian_sua_chua->ReadOnly);

			// nguoi_nhap_lieu
			$this->nguoi_nhap_lieu->setDbValueDef($rsnew, $this->nguoi_nhap_lieu->CurrentValue, NULL, $this->nguoi_nhap_lieu->ReadOnly);

			// dich_vu
			$tmpBool = $this->dich_vu->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->dich_vu->setDbValueDef($rsnew, $tmpBool, NULL, $this->dich_vu->ReadOnly);

			// hoan_thanh
			$tmpBool = $this->hoan_thanh->CurrentValue;
			if ($tmpBool != "1" && $tmpBool != "0")
				$tmpBool = !empty($tmpBool) ? "1" : "0";
			$this->hoan_thanh->setDbValueDef($rsnew, $tmpBool, 0, $this->hoan_thanh->ReadOnly);

			// ghi_chu
			$this->ghi_chu->setDbValueDef($rsnew, $this->ghi_chu->CurrentValue, NULL, $this->ghi_chu->ReadOnly);

			// id_don_hang
			$this->id_don_hang->setDbValueDef($rsnew, $this->id_don_hang->CurrentValue, 0, $this->id_don_hang->ReadOnly);

			// ngay_hoan_thanh
			$this->ngay_hoan_thanh->setDbValueDef($rsnew, UnFormatDateTime($this->ngay_hoan_thanh->CurrentValue, 7), NULL, $this->ngay_hoan_thanh->ReadOnly);

			// Check referential integrity for master table 'ck_don_hang'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_ck_don_hang();
			$keyValue = isset($rsnew['id_don_hang']) ? $rsnew['id_don_hang'] : $rsold['id_don_hang'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["ck_don_hang"]))
					$GLOBALS["ck_don_hang"] = new ck_don_hang();
				$rsmaster = $GLOBALS["ck_don_hang"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "ck_don_hang", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

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

				// Update detail records
				$detailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($editRow) {
					if (in_array("ck_chitiet_suachua", $detailTblVar) && $GLOBALS["ck_chitiet_suachua"]->DetailEdit) {
						if (!isset($GLOBALS["ck_chitiet_suachua_grid"]))
							$GLOBALS["ck_chitiet_suachua_grid"] = new ck_chitiet_suachua_grid(); // Get detail page object
						$Security->loadCurrentUserLevel($this->ProjectID . "ck_chitiet_suachua"); // Load user level of detail table
						$editRow = $GLOBALS["ck_chitiet_suachua_grid"]->gridUpdate();
						$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() != "") {
					if ($editRow) {
						$conn->commitTrans(); // Commit transaction
					} else {
						$conn->rollbackTrans(); // Rollback transaction
					}
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
			if ($masterTblVar == "ck_don_hang") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("id_don_hang"))) !== NULL) {
					$GLOBALS["ck_don_hang"]->id->setQueryStringValue($parm);
					$this->id_don_hang->setQueryStringValue($GLOBALS["ck_don_hang"]->id->QueryStringValue);
					$this->id_don_hang->setSessionValue($this->id_don_hang->QueryStringValue);
					if (!is_numeric($GLOBALS["ck_don_hang"]->id->QueryStringValue))
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
			if ($masterTblVar == "ck_don_hang") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("id_don_hang"))) !== NULL) {
					$GLOBALS["ck_don_hang"]->id->setFormValue($parm);
					$this->id_don_hang->setFormValue($GLOBALS["ck_don_hang"]->id->FormValue);
					$this->id_don_hang->setSessionValue($this->id_don_hang->FormValue);
					if (!is_numeric($GLOBALS["ck_don_hang"]->id->FormValue))
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
			if ($masterTblVar != "ck_don_hang") {
				if ($this->id_don_hang->CurrentValue == "")
					$this->id_don_hang->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("ck_chitiet_suachua", $detailTblVar)) {
				if (!isset($GLOBALS["ck_chitiet_suachua_grid"]))
					$GLOBALS["ck_chitiet_suachua_grid"] = new ck_chitiet_suachua_grid();
				if ($GLOBALS["ck_chitiet_suachua_grid"]->DetailEdit) {
					$GLOBALS["ck_chitiet_suachua_grid"]->CurrentMode = "edit";
					$GLOBALS["ck_chitiet_suachua_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["ck_chitiet_suachua_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["ck_chitiet_suachua_grid"]->setStartRecordNumber(1);
					$GLOBALS["ck_chitiet_suachua_grid"]->sua_chua_id->IsDetailKey = TRUE;
					$GLOBALS["ck_chitiet_suachua_grid"]->sua_chua_id->CurrentValue = $this->sua_chua_id->CurrentValue;
					$GLOBALS["ck_chitiet_suachua_grid"]->sua_chua_id->setSessionValue($GLOBALS["ck_chitiet_suachua_grid"]->sua_chua_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ck_danhmuc_suachualist.php"), "", $this->TableVar, TRUE);
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
				case "x_chuanloai_id":
					break;
				case "x_thiet_bi_id":
					break;
				case "x_nguoi_nhap_lieu":
					$conn = Conn("diavatly");
					$lookupFilter = function() {
						return "`bo_phan_id`=18";
					};
					$lookupFilter = $lookupFilter->bindTo($this);
					break;
				case "x_dich_vu":
					break;
				case "x_hoan_thanh":
					break;
				case "x_id_don_hang":
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
						case "x_chuanloai_id":
							break;
						case "x_thiet_bi_id":
							break;
						case "x_nguoi_nhap_lieu":
							break;
						case "x_id_don_hang":
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