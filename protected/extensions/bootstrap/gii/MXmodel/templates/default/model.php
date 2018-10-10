<?php
/**
 * This is the template for generating the model class of a specified table.
 * - $this: the ModelCode object
 * - $tableName: the table name for this class (prefix is already removed if necessary)
 * - $modelClass: the model class name
 * - $columns: list of table columns (name=>CDbColumnSchema)
 * - $labels: list of attribute labels (name=>label)
 * - $rules: list of validation rules
 * - $relations: list of relations (name=>relation declaration)
 */
$table=$this->getTableSchema($tableName);
$pk=$table->primaryKey;
?>
<?php echo "<?php\n"; ?>

/**
 * This is the model class for table "<?php echo $tableName; ?>".
 *
 * The followings are the available columns in table '<?php echo $tableName; ?>':
<?php foreach($columns as $column): ?>
 * @property <?php echo $column->type.' $'.$column->name."\n"; ?>
<?php endforeach; ?>
<?php if(!empty($relations)): ?>
 *
 * The followings are the available model relations:
<?php foreach($relations as $name=>$relation): ?>
 * @property <?php
	if (preg_match("~^array\(self::([^,]+), '([^']+)', '([^']+)'\)$~", $relation, $matches))
    {
        $relationType = $matches[1];
        $relationModel = $matches[2];

        switch($relationType){
            case 'HAS_ONE':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'BELONGS_TO':
                echo $relationModel.' $'.$name."\n";
            break;
            case 'HAS_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            case 'MANY_MANY':
                echo $relationModel.'[] $'.$name."\n";
            break;
            default:
                echo 'mixed $'.$name."\n";
        }
	}
    ?>
<?php endforeach; ?>
<?php endif; ?>
 */
class <?php echo $modelClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '<?php echo $tableName; ?>';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
<?php foreach($rules as $rule): ?>
			<?php echo $rule.",\n"; ?>
<?php endforeach; ?>
<?php foreach($columns as $column) {
    if (InputTypes::checkColumnType($column) == InputTypes::image || InputTypes::checkColumnType($column) == InputTypes::imageAjax ||
        InputTypes::checkColumnType($column) == InputTypes::file || InputTypes::checkColumnType($column) == InputTypes::fileAjax
    ) {
        $comment = mb_strtolower($column->comment);
        $values = trim(substr($comment, strpos($comment, ":") + 1));
        if ($column->allowNull) {
            echo "\t\t\tarray('{$column->name}', 'file', 'types' => '{$values}', 'allowEmpty' => true, 'except'=>'except_{$column->name}'),\n";
        } else {
            echo "\t\t\tarray('{$column->name}', 'file', 'types' => '{$values}', 'allowEmpty' => true, 'on' => 'update', 'except'=>'except_{$column->name}'),
            array('{$column->name}', 'file', 'types' => '{$values}', 'allowEmpty' => false, 'on' => 'create'),\n";
        }
    }
}
?>
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('<?php echo implode(', ', array_keys($columns)); ?>', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
<?php foreach($relations as $name=>$relation): ?>
			<?php echo "'$name' => $relation,\n"; ?>
<?php endforeach; ?>
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
<?php foreach($labels as $name=>$label): ?>
			<?php echo "'".$name."' => Yii::t('tx', '".str_replace("'","\'",$label)."'),\n"; ?>
<?php endforeach; ?>
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

<?php
foreach($columns as $name=>$column)
{
    if(InputTypes::checkColumnType($column)==InputTypes::manyToManyR){
        $comment = mb_strtolower($column->comment);
        $table_field=substr($comment, strpos($comment, ":") + 1);
        $table_field=explode(',',$table_field);
        $m=new MXModelCode(); $m->tableName=$table_field[0];  $m->init();
        $modelName=$m->generateClassName($m->tableName);
        $id=$this->getTableSchema($tableName)->primaryKey;
        echo "\t\tif(\$this->$name!=null){
            \$criteria2=new CDbCriteria();
            \$criteria2->compare('$table_field[1]',\$this->$name,true);
            \$models=$modelName::model()->findAll(\$criteria2);

            \$criteria3=new CDbCriteria();
            foreach(\$models as \$t){
                \$criteria3->compare('$name',' '.\$t->$id.' ',true,'OR');
            }
            \$criteria->mergeWith(\$criteria3);
        }";
    }elseif($column->type==='string')
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name,true);\n";
	}
	else
	{
		echo "\t\t\$criteria->compare('$name',\$this->$name);\n";
	}
}
?>

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort' => array('defaultOrder' => '<?php echo $pk; ?> DESC'),
            'pagination' => array('pageSize' => 25),
		    ));
	}

<?php if($connectionId!='db'):?>
	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()-><?php echo $connectionId ?>;
	}

<?php endif?>
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return <?php echo $modelClass; ?> the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

<?php
$url_parameter="'{$pk}' => \$this->{$pk}";
foreach($columns as $column) {
    if (InputTypes::checkColumnType($column) == InputTypes::slug){
    $url_parameter="'slug' => \$this->slug";
}}?>
    public function getUrl() {
        return Yii::app()->createUrl('<?php echo $this->modelClass; ?>/view', array(<?php echo $url_parameter; ?>));
    }
    public function getA_Url() {
        return Yii::app()->createAbsoluteUrl('<?php echo $this->modelClass; ?>/view', array(<?php echo $url_parameter; ?>));
    }

<?php
$behaviors=false;
foreach($columns as $column) {
    if (InputTypes::checkColumnType($column) == InputTypes::gallery || InputTypes::checkColumnType($column) == InputTypes::slug)
        $behaviors=true;
}

if($behaviors){ ?>
    public function behaviors() {
        return array(
<?php foreach($columns as $column) {
if(InputTypes::checkColumnType($column) == InputTypes::gallery){?>
                'galleryBehavior' => array(
                    'class' => 'GalleryBehavior',
                    'idAttribute' => '<?php echo $column->name; ?>',
                    'versions' => array(
                        'small' => array(
                            'centeredpreview' => array(98, 98),
                        ),
                        'medium' => array(
                            'resize' => array(800, null),
                        )
                    ),
                    'name' => true,
                    'description' => true,
                ),
<?php }
if(InputTypes::checkColumnType($column) == InputTypes::slug){
    //$comment = mb_strtolower($column->comment);
    //$fieldName=substr($comment, strpos($comment, ":") + 1);
    ?>
                'sluggable' => array(
                    'class' => 'ext.slug.SlugBehavior',
                    'slug_col' => 'slug',
                    'title_col' => '<?php echo trim($column->name); ?>',
                    'max_slug_chars' => 500,
                    'overwrite' => false
                ),
<?php } ?>
<?php } ?>
        );
    }
<?php } ?>

<?php foreach($columns as $column) {
    if (InputTypes::checkColumnType($column) == InputTypes::gallery){ ?>
    public function getGallery() {
        $model = GalleryPhoto::model()->findAllByAttributes(array("gallery_id"=>  $this-><?php echo $column->name; ?>));
        return $model;
    }
<?php } } ?>

<?php foreach($columns as $column) {
    if (InputTypes::checkColumnType($column) == InputTypes::image || InputTypes::checkColumnType($column) == InputTypes::imageAjax) { ?>
    public function get_<?php echo $column->name; ?>() {
        return Yii::app()->baseUrl . "/upload/" . $this-><?php echo $column->name; ?>;
    }

    public function getAbsolute<?php echo $column->name; ?>(){
        return Yii::getpathOfAlias('webroot')."/upload/".$this-><?php echo $column->name; ?>;
    }
<?php } } ?>

<?php
$afterDeleteRequired=false;
foreach($columns as $column) {
if (InputTypes::checkColumnType($column) == InputTypes::image || InputTypes::checkColumnType($column) == InputTypes::imageAjax ||
    InputTypes::checkColumnType($column) == InputTypes::file || InputTypes::checkColumnType($column) == InputTypes::fileAjax) {
    $afterDeleteRequired=true;
    break;
}}
if($afterDeleteRequired){ ?>
    public function afterDelete() {
        parent::afterDelete();
<?php foreach($columns as $column) {
    if (InputTypes::checkColumnType($column) == InputTypes::image || InputTypes::checkColumnType($column) == InputTypes::imageAjax){ ?>
        $img_<?php echo $column->name; ?> = Yii::app()->basePath . '/../upload/' . $this-><?php echo $column->name; ?>;
        if (file_exists($img_<?php echo $column->name; ?>) && $this-><?php echo $column->name; ?>)
            unlink($img_<?php echo $column->name; ?>);
    <?php }
    if(InputTypes::checkColumnType($column) == InputTypes::file || InputTypes::checkColumnType($column) == InputTypes::fileAjax){ ?>
        $f_<?php echo $column->name; ?> = Yii::app()->basePath . '/../upload/' . $this-><?php echo $column->name; ?>;
        if (file_exists($f_<?php echo $column->name; ?>) && $this-><?php echo $column->name; ?>)
            unlink($f_<?php echo $column->name; ?>);
    <?php }  ?>
<?php }  ?>
}
<?php }  ?>

}
